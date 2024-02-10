<?php 

session_start();
include('includes/dbconnection.php');

$facid = $_SESSION['famsid'];

    if(isset($_POST['delete_appointment'])) {
        $appointment_id = $_POST['appointment_id'];
        // Perform the deletion query here
        $sql = "DELETE FROM tblappointment WHERE ID = :appointment_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':appointment_id', $appointment_id, PDO::PARAM_INT);
        if($query->execute()) {
            // Send a success response
            echo json_encode(['status' => 'success']);
            exit; // stop further execution
        } else {
            // Send an error response
            echo json_encode(['status' => 'error']);
            exit; // stop further execution
        }
    }
?>