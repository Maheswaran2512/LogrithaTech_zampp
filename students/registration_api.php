<?php
header("Access-Control-Allow-Origin:*");
$name = "";
$email = "";
$mobile = "";
$error_flag = true;
$results = [];
$results["name_error"] = "";
$results["email_error"] = "";
$results["mobile_error"] = "";

// name Validation
if (isset($_GET["name"])) {
    if ($_GET["name"] != "") {
        $name = htmlspecialchars($_GET["name"]);
        $results["name_error"] = "";
    } else {
        $results["name_error"] = "Name Value Not Found";
        $error_flag = false;
    }
} else {
    $results["name_error"] = "Name Parameter Not Found";
    $error_flag = false;
}

// email Validation
if (isset($_GET["email"])) {
    if ($_GET["email"] != "") {
        $email = htmlspecialchars($_GET["email"]);
        $results["email_error"] = "";
    } else {
        $results["email_error"] = "Email Value Not Found";
        $error_flag = false;
    }
} else {
    $results["email_error"] = "Email Parameter Not Found";
    $error_flag = false;
}

//mobile Validation
if (isset($_GET["mobile"])) {
    if ($_GET["mobile"] != "") {
        $mobile = $_GET["mobile"];
        $results["mobile_error"] = "";
    } else {
        $results["mobile_error"] = "Mobile Value Not Found";
        $error_flag = false;
    }
} else {
    $results["mobile_error"] = "Mobile Parameter Not Found";
    $error_flag = false;
}

if ($error_flag) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $results["dberror"] = $conn->connect_error;
        // echo ("Connection failed: " . $conn->connect_error);
    } else {
        echo ("connection Successful");
        $select_query = "SELECT * FROM stuednt_db WHERE email='$email'";
        $table_result = $conn->query($select_query);

        if ($table_result->num_rows > 0) {
            $results["email_error"] = "Email Already Exists";
        } else {

            $sql = "INSERT INTO student_db ( name , email , mobile)
            VALUES ('$name', '$email', '$mobile')";

            if ($conn->query($sql) === TRUE) {
                $results["success"] = "Data Inserted Successfully";
            } else {
                $results["dberror"] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
} else {
    $results["success"] = "";
}
// echo (json_encode($results));
?>