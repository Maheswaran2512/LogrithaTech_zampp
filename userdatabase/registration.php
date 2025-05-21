<?php

header("Access-Control-Allow-Origin:*");

$name = "";
$email = "";
$mobile = "";
$c_password = "";
$error_flag = true;
$results = [];
$results["name_error"]="";
$results["email_error"]="";
$results["mobile_error"]="";
$results["c_password_error"]="";

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
// echo ($mobile);

//password Validation
if (isset($_GET["password"])) {
    if ($_GET["password"] != "") {
        $c_password = $_GET["password"];
        $results["password_error"] = "";
    } else {
        $results["password_error"] = "Password Value Not Found";
        $error_flag = false;
    }
} else {
    $results["password_error"] = "Password Parameter Not Found";
    $error_flag = false;
}


if ($error_flag) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "college";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $results["dberror"] = $conn->connect_error;
        // echo ("Connection failed: " . $conn->connect_error);
    } else {

        $select_query = "SELECT * FROM user_table WHERE email='$email'";
        $table_result = $conn->query($select_query);

        // echo($select_query);
        // if(0){

        if ($table_result->num_rows > 0) {

            $results["email_error"] = "Email Already Exists";

        } else {
            // echo ($mobile);
            $sql = "INSERT INTO user_table ( name , email , mobile , password)
            VALUES ('$name', '$email', '$mobile','$c_password')";

            if ($conn->query($sql) === TRUE) {
                $results["success"] = "Data Inserted Successfully";
                // echo "New record created successfully";
            } else {
                $results["dberror"] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
} else {
    $results["success"] = "";
}

echo (json_encode($result));

?>