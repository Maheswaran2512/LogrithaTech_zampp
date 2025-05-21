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
    if ($conn->connect_error) {
        $results["dberror"] = $conn->connect_error;
    } else {
        // echo ("working");
        $emailRegx = "/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
        $email_flag = false;
        $name_flag = false;

        if (preg_match($emailRegx, $name)) {
            $select_query = "SELECT * FROM registration WHERE email='$name'";
            $result = $conn->query($select_query);
            if ($result->num_rows > 0) {
                $email_flag = true;
                $results["name_error"] = "";
            } else {
                $results["name_error"] = "email not registered.";
            }
        } else {
            $select_query = "SELECT * FROM registration WHERE username='$name'";
            $result = $conn->query($select_query);
            if ($result->num_rows > 0) {
                $name_flag = true;
                $results["name_error"] = "";
            } else {
                $results["name_error"] = "username not registered";
            }
        }

        if ($name_flag || $email_flag) {

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["password"] != $c_password) {
                        //  $results["password_error"] = "invalid password".$row['password']."- $c_password";
                         $results["password_error"] = "invalid password";
                    } else {
                        $results["success"] = "valid user";
                    }
                }
            }
        }
        $conn->close();
    }
} else {
    $results["success"] = "";
}
echo (json_encode($results));
?>