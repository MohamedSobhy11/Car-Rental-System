<?php
session_start();
require_once('connection.php');
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$email=$_SESSION['email'];
$phone_number=$_SESSION['phone_number'];
$gender=$_SESSION['gender'];
$password=$_SESSION['password'];
// $password = md5($password);
$query = "INSERT INTO customer (fname,lname,email,phone_number,gender,type,password) VALUES ('$fname','$lname','$email','$phone_number','$gender','user','$password')";
$sql = $con->prepare($query);
$result = $sql->execute();
if($result == 0){
    echo file_get_contents('errors.html');
}else{
    header('Location:login.php'); 
}
?>Runtime disconnected
Your runtime has been disconnected due to inactivity or reaching its maximum duration. Learn more
