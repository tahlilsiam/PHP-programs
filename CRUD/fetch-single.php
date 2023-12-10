<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');

$data = json_decode(file_get_contents("php://input"),true);
$students_id= $data['sid'];
include "config.php";

$sql = "SELECT * FROM `students` WHERE id ={$students_id}";
$results = mysqli_query($conn,$sql) or die("Query Failed");

if(mysqli_num_rows($results)>0){
    $output = mysqli_fetch_all($results, MYSQLI_ASSOC);
    echo json_encode($output);
}else{
    echo json_encode(array('message'=> 'Nothing is found.','status'=> false));
}


?>