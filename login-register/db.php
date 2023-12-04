<?php 

$hostname="localhost";
$username= "root";
$password="";
$dbname="login-register";

$connection = mysqli_connect($hostname,$username,$password,$dbname);

if(!$connection){
    die("Something Went wrong");
}
?>