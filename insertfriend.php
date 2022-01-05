<?php 
session_start();
include_once "projectinfo.php";  
$student = new User;
$stud = $student->insert_friend($_POST['addfriend'],$_POST['friendname'],$_POST['friendid']);
?>