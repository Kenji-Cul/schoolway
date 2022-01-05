<?php 
session_start();
include("projectinfo.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Friend</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


<!-- custom css file link  -->
<link rel="stylesheet" href="style.css">
    </head>
    <body>
    <header>

<a href="index.php" class="logo"><i class="fas fa-graduation-cap"></i><?php echo MY_APP_NAME?></a>

<nav class="navbar">
    <ul>
        <li><a href="index.php" class="active" style="color:#3204ff;">home</a></li>
        <li><a><?php if(isset($_SESSION['student_name'])){
            echo $_SESSION['student_name'];
        }else{
            echo "Name";
        }?></a></li>
        <li><a><?php if(isset($_SESSION['student_name'])){
            echo $_SESSION['student_class'];
        }else{
            echo "Class";
        }?></a></li>
        <?php if(isset($_SESSION['student_name'])){?><li><a href="logoutpage.php">Logout</a></li><?php }?>
        <li> <?php 
            if(isset($_SESSION['student_name'])){
             $teacher = new User;
             $teacherpic = $teacher->select_studentprofile($_SESSION['student_email']);
             foreach($teacherpic as $key => $value){
               if(!empty($teacherpic)){
            ?>
           <?php if(empty($value['photo'])){?>
            <img src="images/usericons.png"  style="border-radius:50%; height:4rem; width:4rem;">
            <?php }else{?>
            <img src="profile/<?php echo $value['photo'];?>"  style="border-radius:50%; height:4rem; width:4rem;">
            <?php }?>
            <?php }}?>
            <?php }?>
        </li>
    </ul>
</nav>

<div class="fas fa-bars"></div>

</header>

 <section style="align-items:center; justify-content:center; padding-top:15rem; margin-left:59rem;">
 <?php 
$id = $_GET['scholar_id'];
$student = new User;
$stud = $student->select_studentid($id);
foreach($stud as $key => $value){
    if(!empty($stud)){
?>
     <div class="col-div-12">
         <?php if(empty($value['photo'])){?>
            <img src="images/usericons.png" style="border-radius:50%; width:17rem; height:17rem; border:5px solid blue;">
         <?php }else{?>
         <img src="profile/<?php echo $value['photo']?>" style="border-radius:50%; width:17rem; height:17rem; border:5px solid blue;">
         <?php }?>
     </div>
 </section>

 <section id="teacher" class="teacher">
        <h1 class="heading"><?php echo $value['username'];?></h1>
        <h1 class="heading"><?php echo $value['class'];?></h1>

        <div class="card-container">
           <div class="card scholar">
           <h3 class="title">See bio</h3>
           <?php if(!empty($value['bio'])){?>
            <h2><?php echo $value['bio'];?></h2>
            <?php }else{?>
                <h2><?php echo $value['username']?> has not added any bio</h2>
            <?php }}}?>
            <form class="formarea">
            <input type="text" name="addfriend" value="<?php echo $_SESSION['unique_id'];?>" hidden>
                <input type="text" name="friendname" value="<?php echo $value['username'];?>" hidden>
                <input type="text" name="friendid" value="<?php echo $value['unique_id'];?>" hidden>
                <h3 style="margin-top:7px; cursor:pointer;" class="hbutton">Add Friend</h3>
            </form>
        </div>

    </section>
        
    <script src="javascript/index.js"></script>   
    </body>
</html>