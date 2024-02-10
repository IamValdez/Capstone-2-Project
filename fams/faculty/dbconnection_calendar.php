<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";

// Create connection
$conn = new mysqli('localhost','root','','famsmsdb');
$added= mysql_query("ALTER TABLE tblappointment ADD StudentName VARCHAR(255) NULL");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the event data from the AJAX call
$eventData = $_POST['eventData'];
$title = $eventData['title'];
$start = $eventData['start'];

// Insert the event into the database
$sql = "INSERT INTO events (title, start) VALUES ('$title', '$start')";
if ($conn->query($sql) == TRUE) {
  echo "Event added successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>