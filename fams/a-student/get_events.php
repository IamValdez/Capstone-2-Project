<?php
session_start();
include('includes/dbconnection.php');

$facid = $_SESSION['famsid'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $facid = $_POST['facid'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Query to fetch appointments for the specified user and within the calendar date range
    $sql = "SELECT * FROM tblappointment WHERE famsemailid = :facid AND AppointmentDate BETWEEN :start AND :end";

    $query = $dbh->prepare($sql);
    $query->bindParam(':facid', $facid, PDO::PARAM_STR);
    $query->bindParam(':start', $start, PDO::PARAM_STR);
    $query->bindParam(':end', $end, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $events = array();

    foreach ($results as $result) {
        // Define each event as an object with necessary properties
        $event = array(
            'title' => date('g:i A', strtotime($result->AppointmentTime)),
            'start' => $result->AppointmentDate . 'T' . $result->AppointmentTime,
            'end' => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($result->AppointmentDate . ' ' . $result->AppointmentTime))),
            'allDay' => true,
            'description' => $result->FullName // Display full name at bottom of event
        );
        array_push($events, $event);
    }

    // Output events in JSON format
    echo json_encode($events);
}
?>