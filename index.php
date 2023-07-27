<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: display.php");
    exit;
}
include 'connect.php';
function validatePassword($password) {
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);

  if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
      return false;
  } else {
      return true;
  }
}


if(isset($_POST['upload'])){

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];  

if (!validatePassword($password)){
  echo 'Password should be at least 8 characters in length and should include at least one uppercase letter, one lowercase letter, one number, and one special character.';
  }
else{

$userID = $_SESSION["user_id"];
$sql = "INSERT INTO test (user_id, name, email, mobile, password) VALUES ('$userID', '$name', '$email', '$mobile', '$password')";
$result = mysqli_query($conn, $sql);

if($result){
  // echo "Insertion successful";
  header('location:display.php');
  exit;
}
else{
  die(mysqli_error($conn));
}
}
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="container ">
  <form action="" method = "post">
  <div class="">
    <label>Name</label>
    <input type="text" required placeholder="Enter your name" name = "name">
    
  </div>
  <div >
    <label>Email</label>
    <input type="email" placeholder="Enter your email" required name = "email">
    
  </div>
  <div >
    <label>Phone Number</label>
    <input type="tel" placeholder="Enter your phone number" pattern="[0-9]{10}" required name = "mobile">
    
  </div>

  <div>
    <label>Password</label>
    <input type="password" placeholder="Enter your password" required name = "password">
    
  </div>
 
  <button name ="upload" type="submit" class="btn btn-primary">Upload</button>
</form>

  </div>
</body>
</html>