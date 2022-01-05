<?php 
session_start();
ob_start();
include_once "projectinfo.php";
$email = $_GET['unique_id'];
$student = new User;
$stud = $student->select_user($email);
if($stud){
  header("Location:chatpage.php");
}else{
    echo "error connection";
}
ob_end_flush();
?>