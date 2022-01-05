<?php 
include_once "projectinfo.php";
$id = $_GET['id'];
$student = new User;
$stud = $student->update_status($id);
session_start();
session_unset();
session_destroy();
header("Location: index.php?msg=Successfully logged out");
?>
