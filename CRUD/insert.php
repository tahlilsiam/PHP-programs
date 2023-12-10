<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');


$data = json_decode(file_get_contents("php://input"),true);
$students_name= $data['sname'];
$students_age= $data['sage'];
$students_city= $data['scity'];
include "config.php";
$sql = "INSERT INTO students (student_name, age, city) VALUES ('{$students_name}', {$students_age}, '{$students_city}')";


if( mysqli_query($conn,$sql)){
    echo json_encode(array('message'=> 'Record Inserted.','status'=> true));
}else{
    echo json_encode(array('message'=> 'Record not Inserted.','status'=> false));
}


?>