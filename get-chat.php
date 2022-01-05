<?php 
session_start();
include_once "projectinfo.php";
if(isset($_SESSION['unique_id'])){
    $student = new User;
    $stud = $student->get_messages($_POST['outgoing_id'],$_POST['incoming_id']);
}
?>