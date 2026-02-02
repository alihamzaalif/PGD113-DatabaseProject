<?php
    $servername = "localhost";
	$username = "root";
	$password = "";
	$DBname = "hamza_project";
// Create connection
	$conn = new mysqli($servername, $username, $password,$DBname);

// Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>