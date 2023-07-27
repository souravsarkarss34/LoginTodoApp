<?php
$conn = new mysqli('localhost','root','goldtre9','CRUD');
if($conn->connect_error)
{
    die("connection failed");

}else{
// echo 'conected';
}

?>