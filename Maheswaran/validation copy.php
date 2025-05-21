<?php
$page = "Back-end Validation<br>";
echo ($page);

function validation($var_ip, $error_msg)
{
  // if ($var_ip == "") {
  if (empty($var_ip)) {
    echo ($error_msg . "<br>");
    return false;
  } else {
    echo ($var_ip . "<br>");
    // echo ("");
    return true;
  }
}

$error_flag=true;

$name = $_GET["name"];
// echo ($name . "<br>");
// if ($name == "") {
//   echo ("Please Enter Your Name<br>");
// }
validation($name, "Enter Your Name");


$email = $_GET["email"];
// echo ($email . "<br>");
// if ($email == "") {
//   echo ("Please Enter Your email<br>");
// }
$emailReg = "/^[a-z0-9._]+@[a-z0-9]+\.[a-z]{2,}$/";

validation($email, "Enter Your Email");


$mobile = $_GET["mobile"];
// echo ($mobile . "<br>");
// if ($mobile == "") {
//   echo ("Please Enter Your mobile<br>");
// }
// if(validation($mobile, "Enter Your Mobile Number")){
  $mobilereg = "/^[0-9]{10}$/";
  if(preg_match($mobilereg,$mobile)){
    echo($mobile."<br>");
  }else{
    echo"Plese enter 10digit number<br>";
  }
// }

$password = $_GET["password"];
$c_password = $_GET["c_password"];

// echo ($password . "<br>");
// echo ($c_password . "<br>");
// if ($password != $c_password) {
//   echo ("Incorrect Password<br>");
// }
$pass_flag=true;

if(!validation($password,"Plz Enter the password")){
  $pass_flag=false;
}

if(!validation($c_password,"Plz Enter the c_password")){
  $pass_flag=false;
}

if($pass_flag){
  if($password!=$c_password){
    echo "invalid Password";
  }else{
    echo "valid<br>";
  }
}






?>