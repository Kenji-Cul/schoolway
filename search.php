<?php 
session_start();
include_once "projectinfo.php";
$student = new User;
$stud = $student->select_friend($_SESSION['student_email'],$_POST['searchTerm']);
?>