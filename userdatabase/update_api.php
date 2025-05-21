<?php
header("Access-Control-Allow-Origin:*");
$name = "";
$email = "";
$mobile = "";
$password = "";
$id = "";
$error_flag = true;
$results = [];
$results["id_error"] = "";
$results["name_error"] = "";
$results["email_error"] = "";
$results["mobile_error"] = "";
$results["password_error"] = "";
$results["db_error"] = "";
$results["success"] = "";


// ID Validation
if (isset($_GET["id"])) {
    if ($_GET["id"] != "") {
        $id = $_GET["id"];
        $results["id_error"] = "";
    } else {
        // echo("Name Value Not Found");
        $results["id_error"] = "ID Value Not Found";
        $error_flag = false;
    }

} else {
    // echo("Name Parameter Not Found");
    $results["id_error"] = "ID Parameter Not Found";
    $error_flag = false;
}

// Name Validation
if (isset($_GET["name"])) {
    if ($_GET["name"] != "") {
        $name = $_GET["name"];
        $results["name_error"] = "";
    } else {
        // echo("Name Value Not Found");
        $results["name_error"] = "Name Value Not Found";
        $error_flag = false;
    }

} else {
    // echo("Name Parameter Not Found");
    $results["name_error"] = "Name Parameter Not Found";
    $error_flag = false;
}


// echo($results["name_error"]);

// Email Validation
if (isset($_GET["email"])) {
    if ($_GET["email"] != "") {
        $email = $_GET["email"];
        $results["email_error"] = "";
    } else {
        // echo("Email Value Not Found");
        $results["email_error"] = "Email Value Not Found";
        $error_flag = false;
    }

} else {
    // echo("Email Parameter Not Found");
    $results["email_error"] = "Email Parameter Not Found";
    $error_flag = false;
}


//Mobile Validation

if (isset($_GET["mobile"])) {
    if ($_GET["mobile"] != "") {
        $mobile = $_GET["mobile"];
        $results["mobile_error"] = "";
    } else {
        // echo("Mobile Value Not Found");
        $results["mobile_error"] = "Mobile Value Not Found";
        $error_flag = false;
    }

} else {
    // echo("Mobile Parameter Not Found");
    $results["mobile_error"] = "Mobile Parameter Not Found";
    $error_flag = false;
}
//Password Validation

if (isset($_GET["password"])) {
    if ($_GET["password"] != "") {
        $c_password = $_GET["password"];
        $results["password_error"] = "";
    } else {
        // echo("Mobile Value Not Found");
        $results["password_error"] = "Password Value Not Found";
        $error_flag = false;
    }

} else {
    // echo("Mobile Parameter Not Found");
    $results["password_error"] = "password Parameter Not Found";
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
            // $results["email_error"]="Email Already Exist";
            $sql = "UPDATE user_table SET name='$name',email='$email',mobile='$mobile',password='$c_password' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                // echo "Record updated successfully";
                $results["success"] = "Data Updated Successfully";
            } else {
                $results["db_error"] = "Error updating record: " . $conn->error;
                // echo "Error updating record: " . $conn->error;
            }
        } else {
            $results["id_error"] = "Invalid ID";
            // $sql = "INSERT INTO students (name, email, mobile)
            // VALUES ('$name', '$email', '$mobile')";
            // if ($conn->query($sql) === TRUE) {
            //     $results["success"]="User Registered Successfully";
            // } else {
            //     $results["db_error"]="Error: " . $sql . "<br>" . $conn->error; 
            // }
        }
    }
    $conn->close();
} else {
    $results["success"] = "";
}
echo (json_encode($results));

/*
Needed Parameters:
name (string(30)) - 1/2 Spaces Allowed, one or 2 .(Dots) Allowed
email (string(50)) - Email Format (Unique)
mobile (string(50)) - 10 Digits Allowed ans starts with 6/7/8/9


Method : GET
API URl : http://localhost/new_form/


Return Values :
Case 1 : True
{
  "name_error": "",
  "email_error": "",
  "mobile_error": "",
  "db_error" :"",
  "success": "Data Inserted Successfully"
}

case 2 : Name Error

{
  "name_error": "Name Value Not Found",
  "email_error": "",
  "mobile_error": "",
  "success": ""
}


case 2 : Email Error

{
  "name_error": "",
  "email_error": "Email Value Not Found",
  "mobile_error": "",
  "success": ""
}
*/
