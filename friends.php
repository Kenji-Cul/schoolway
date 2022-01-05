<?php 
session_start();
include_once "projectinfo.php";
$student = new User;
$stud = $student->select_friends($_SESSION['unique_id']);
?>