<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
$id = "";
$results = [];
$results["iderror"]="";
$results["success"]="";
$error_flag = true;

// id Validation
if (isset($_GET["id"])) {
    if ($_GET["id"] != "") {
        $id = $_GET["id"];
    } else {
        $results["iderror"] = "ID Value Not Found";
        // echo ("ID Value Not Found <br>");
        $error_flag = false;
    }
} else {
    $results["iderror"] = "ID Parameter Not Found ";
    // echo("ID Parameter Not Found <br>");
    $error_flag = false;
}

if ($error_flag) {
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $results["db_error"] = "Connection failed: " . $conn->connect_error;
    echo json_encode($results);
    exit;
}

// Fetch students list
$sql = "SELECT * FROM user_table WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Add each student to the results
    while($row = $result->fetch_assoc()) {
        $results["id"]= $row["id"];
        $results["name"]= $row["name"];
        $results["email"]= $row["email"];
        $results["mobile"]= $row["mobile"];
        $results["success"]= "Data Found";


        // $row["id"],
        //     "name" => $row["name"],
        //     "email" => $row["email"],
        //     "mobile" => $row["mobile"]
        // ];
        // $results["students"][] = $student;  // Its similar to array_push();
    }
} else {
    $results["db_error"] = "No records found.";
}

// Close the database connection
$conn->close();
}
// Output the results as JSON
echo json_encode($results);
