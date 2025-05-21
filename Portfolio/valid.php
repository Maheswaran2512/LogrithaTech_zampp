<?php
// $name = $_GET["user_name"];
// $email = $_GET["email"];
// $mobile = $_GET["mobile"];
// $message = $_GET["message"];
header("Access-Control-Allow-Orign:*");
header("Access-Control-Allow-Methods:GET");
// if($_SERVER["REQUEST_METHOD"]!=="POST"){
//     //LINE OF CODE
// }
$results=[];

if (isset($_GET["name"])) {
    $name = $_GET["name"];
    // echo ($name . "<br>");
    $results["name_error"] = "";
} else {
    $results["name_error"] = "Name Parameter not found";
    // echo ("$name parameter not found<br>");
    
}

if (isset($_GET["email"])) {
    $email = $_GET["email"];
    echo ($email . "<br>");
} else {
    echo ("$email parameter not found<br>");
}

if (isset($_GET["mobile"])) {
    $mobile = $_GET["mobile"];
    echo ($mobile . "<br>");
} else {
    echo ("$mobile parameter not found<br>");
}

if (isset($_GET["message"])) {
    $message = $_GET["message"];
    echo ($message . "<br>");
} else {
    echo ("$message parameter not found<br>");
}

if (isset($_GET["radio"])) {
    $radio = $_GET["radio"];
    echo ($radio . "<br>");
} else {
    echo ("$radio parameter not found<br>");
}

if (isset($_GET["checkbox"])) {
    $checkbox = $_GET["checkbox"];
    print_r($checkbox);
    $checkbox_string = implode(", ", $checkbox);
} else {
    echo ($checkbox . "parameter not found <br>");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
} else {
    $sql = "INSERT INTO client (username, email,mobile,message,radio,checkbox)
    VALUES ('$name', '$email', '$mobile','$message','$radio','$checkbox_string')";

    if ($conn->query($sql) === TRUE) {
        echo "<br>New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}




?>