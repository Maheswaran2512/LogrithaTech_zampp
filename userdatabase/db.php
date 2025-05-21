<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
$db_error = false;
if ($conn->connect_error) {
    //   echo("Connection failed: " . $conn->connect_error);
    $results["db_error"] = "Connection failed: " . $conn->connect_error;
    $db_error = true;
}