<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit;
}
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="delete from `test` where id =$id";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        $_SESSION['deleted_message'] = "Record deleted successfully.";
        // echo "Table Deleted";
        header('location:display.php');
    }
    else{
        die(mysqli_error($conn));
    }
}
?>