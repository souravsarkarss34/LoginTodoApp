<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit;
}
include 'connect.php';
$id=$_GET['updateid'];
$sql="select * from `test` where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$password = $row['password'];
if(isset($_POST['upload'])){

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];  

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
if (!validatePassword($password)) {
    echo 'Password should be at least 8 characters in length and should include at least one uppercase letter, one lowercase letter, one number, and one special character.';
 
}else{
$sql = "update `test` set id=$id,name='$name',email='$email',mobile='$mobile',password='$password' 
where id=$id";
$result=mysqli_query($conn,$sql);
if($result){
// echo "Table update";
  header('location:display.php');
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
    <input type="text" placeholder="Enter your name" name = "name" value=<?php echo $name;?>>
    
  </div>
  <div >
    <label>Email</label>
    <input type="email" placeholder="Enter your email" required name = "email" value=<?php echo $email;?>>
    
  </div>
  <div >
    <label>Phone Number</label>
    <input type="tel" placeholder="Enter your phone number" required pattern="[0-9]{10}" name = "mobile" value=<?php echo $mobile;?>>
    
  </div>

  <div>
    <label>Password</label>
    <input type="password" placeholder="Enter your password" required name = "password" value=<?php echo $password;?>>
    
  </div>
 
  <button name ="upload" type="submit" class="btn btn-primary">Update</button>
</form>
  </div>
</body>
</html>