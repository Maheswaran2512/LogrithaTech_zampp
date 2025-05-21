<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");

$name = "";
$c_password = "";
$results = [];
$results["name_error"] = "";
$results["password_error"] = "";
$results["dberror"] = "";
$results["success"] = "";
$error_flag = true;

if (isset($_POST["name"])) {
    if ($_POST["name"] != "") {
        $name = htmlspecialchars($_POST["name"]);
        $results["name_error"] = "";
    } else {
        $results["name_error"] = "name value not found.";
        $error_flag = false;
    }
} else {
    $results["name_error"] = "name parameter not found.";
    $error_flag = false;
}

if (isset($_POST["password"])) {
    if ($_POST["password"] != "") {
        $c_password = htmlspecialchars($_POST["password"]);
        $results["password_error"] = "";
        $error_flag = true;
    } else {
        $results["password_error"] = "password value not found.";
        $error_flag = false;
    }
} else {
    $results["password_error"] = "password parameter not found.";
    $error_flag = false;
}

if ($error_flag) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "authentication";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $db_error = false;

    if ($conn->connect_error) {
        //   echo("Connection failed: " . $conn->connect_error);
        $results["dberror"] = "Connection failed: " . $conn->connect_error;
        $db_error = true;
    } else {
        $emailRegx = "/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
        $email_flag = false;
        $name_flag = false;

        if (preg_match($emailRegx, $name)) {
            // $select_query = "SELECT * FROM registration WHERE email='$name'";
            $select_query = "UPDATE registration SET password='$c_password' WHERE email='$name'";
            $result = $conn->query($select_query);
            $email_flag = true;

            // php mailer
            // if ($result->num_rows > 0) {
            //     $email_flag = true;
            //     $results["name_error"] = "";
            // } else {
            //     $results["name_error"] = "email not registered.";
            // }
        } else {
            // $select_query = "SELECT * FROM registration WHERE username='$name'";
            $select_query = "UPDATE registration SET password='$c_password' WHERE name='$name'";
            $result = $conn->query($select_query);
            $name_flag = true;

            // if ($result->num_rows > 0) {
            //     $name_flag = true;
            //     $results["name_error"] = "";
            // } else {
            //     $results["name_error"] = "username not registered";
            // }
        }
        if ($name_flag || $email_flag) {
            $results["success"] = "Update Successfully";
        } else {
            $results["dberror"] = "Error record not found: " . $conn->error;
        }

        // $sql = "UPDATE registration SET password='$c_password' WHERE name='$name'";
        // if ($conn->query($sql) === TRUE) {
        //     $results["success"] = "Password Updated Successfully";
        // } else {
        //     $results["dberror"] = "Error updating record: " . $conn->error;
        // }
    }
    $conn->close();
} else {
    $results["success"] = "";
}
echo (json_encode($results));
?>