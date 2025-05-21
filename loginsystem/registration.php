<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");

$name = "";
$email = "";
$c_password = "";
$results = [];
$results["name_error"] = "";
$results["email_error"] = "";
$results["password_error"] = "";
$results["dberror"] = "";  
$results["success"] = "";
$error_flag = true;

// if (isset($_POST["name"])) {
//     if ($_POST["name"] != "") {
//         $name = htmlspecialchars($_POST["name"]);
//         $results["name_error"] = "";
//         $error_flag = true;
//     } else {
//         $results["name_error"] = "name value not found.";
//         $error_flag = false;
//     }
// } else {
//     $results["name_error"] = "name parameter not found.";
//     $error_flag = false;
// }

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

if (isset($_POST["email"])) {
    if ($_POST["email"] != "") {
        $email = htmlspecialchars($_POST["email"]);
        $results["email_error"] = "";
        $error_flag = true;
    } else {
        $results["email_error"] = "email value not found.";
        $error_flag = false;
    }
} else {
    $results["email_error"] = "email parameter not found.";
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
        $select_query = "SELECT * FROM registration WHERE email='$email'";
        $result = $conn->query($select_query);
        if ($result->num_rows > 0) {
            $results["email_error"] = "Email Already Exists";
        } else {
            $sql = "INSERT INTO registration ( username , email , password)
            VALUES ('$name', '$email' , '$c_password')";

            if ($conn->query($sql) === TRUE) {  
                $results["success"] = "Data Inserted Successfully";
            } else {
                $results["dberror"] = "Error:" . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
} else {
    $results["success"] = "";
}

echo (json_encode($results));

?>