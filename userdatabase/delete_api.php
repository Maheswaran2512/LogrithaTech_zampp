<?php
header("Access-Control-Allow-Origin:*");
$id = "";
$results = [];
$results["iderror"]="";
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

    if (!$db_error) {

        $select_query = "SELECT * FROM user_table WHERE id='$id'";
        $result = $conn->query($select_query);

        if ($result->num_rows > 0) {

            $delete_query = "DELETE FROM user_table WHERE id='$id'";

            if ($conn->query($delete_query) === TRUE) {
                $results["success"] = "Data Deleted Successfully";
                // echo("Data Deleted Successfully");
            } else {
                // echo("Connection Error:".$conn->error);
                $results["dberror"] = "Connection Error:.$conn->error";

            }

        } else {
            $results["iderror"] = "Id Not Found";
            // echo("Invalid ID <br>");
        }

    }

    echo (json_encode($results));
}