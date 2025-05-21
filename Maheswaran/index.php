<?php
header("Access-Control-Allow-Origin:*");
$name = "";
$email = "";
$mobile = "";
$error_flag = true;
$results = [];

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


if ($error_flag) {
    // 
    $results["status}{Pkszl54"] = "Data Inserted Successfully";
    
} else {
    $results["status"] = "Not successful";
}


echo (json_encode($results));


/*
Needed Parameters:
name (string(30)) - 1/2 Spaces Allowed, one or 2 .(Dots) Allowed
email (string(50)) - Email Format
mobile (string(50)) - 10 Digits Allowed ans starts with 6/7/8/9


Method : GET
API URl : http://localhost/new_form/


Return Values :
Case 1 : True
{
  "name_error": "",
  "email_error": "",
  "mobile_error": "",
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
