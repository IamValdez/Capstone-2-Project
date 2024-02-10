<?php
session_start();
include('includes/dbconnection.php');

$facid = $_SESSION['famsid'];

try {

    if (isset($_GET['timePeriod'])) {

        $sql = "SELECT 
            (SELECT COUNT(*) FROM tblappointment WHERE Status IS NULL AND Faculty=:facid) AS newCount,
            (SELECT COUNT(*) FROM tblappointment WHERE Status='Approved' AND Faculty=:facid) AS approvedCount,
            (SELECT COUNT(*) FROM tblappointment WHERE Status='Cancelled' AND Faculty=:facid) AS cancelledCount,
            (SELECT COUNT(*) FROM tblappointment WHERE Faculty=:facid) AS totalCount";
        $query = $dbh->prepare($sql);
        $query->bindParam(':facid', $facid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetch(PDO::FETCH_ASSOC);

        $newCount = $results['newCount'] ?? 0;
        $approvedCount = $results['approvedCount'] ?? 0;
        $cancelledCount = $results['cancelledCount'] ?? 0;
        $totalCount = $results['totalCount'] ?? 0;

        $timePeriod = isset($_GET['timePeriod']) ? $_GET['timePeriod'] : 'monthly';

        // Modify the query to fetch data based on the specified time period
        $sql = "";
        switch ($timePeriod) {
            case 'weekly':
                $sql = "SELECT DATE_FORMAT(AppointmentDate, '%Y-%m-%d') AS date, COUNT(*) AS count 
                FROM tblappointment 
                WHERE Faculty=:facid AND AppointmentDate >= NOW() - INTERVAL 1 WEEK 
                GROUP BY date";
                break;
            case 'monthly':
                $sql = "SELECT DATE_FORMAT(AppointmentDate, '%Y-%m') AS date, COUNT(*) AS count 
                FROM tblappointment 
                WHERE Faculty=:facid AND AppointmentDate >= NOW() - INTERVAL 1 MONTH 
                GROUP BY date";
                break;
            case 'yearly':
                $sql = "SELECT DATE_FORMAT(AppointmentDate, '%Y') AS date, COUNT(*) AS count 
                FROM tblappointment 
                WHERE Faculty=:facid AND AppointmentDate >= NOW() - INTERVAL 1 YEAR 
                GROUP BY date";
                break;
        }

        $query = $dbh->prepare($sql);
        $query->bindParam(':facid', $facid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $labels = array_column($results, 'date');
        $data = array_column($results, 'count');

        header('Content-Type: application/json');
        // Convert data to JSON format
        echo json_encode(['labels' => $labels, 'data' => $data, 'newCount' => $newCount, 'approvedCount' => $approvedCount, 'cancelledCount' => $cancelledCount, 'totalCount' => $totalCount]);
    }
} catch (PDOException $e) {
    // Handle the exception (e.g., log the error, display a user-friendly message)
    echo "Error: " . $e->getMessage();
}