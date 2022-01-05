<?php 
session_start();
include("projectinfo.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>History Topics</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <link rel="stylesheet" href="style.css">
        <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  -->
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
        <?php if(isset($_SESSION['student_name'])){?><li><a href="logoutpage.php?id=<?php echo $_SESSION['unique_id']?>">Logout</a></li><?php }?>
        <li><?php 
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
                    <?php }?></li>
    </ul>
</nav>

<div class="fas fa-bars"></div>

</header>
<section id="teacher" class="teacher" style="margin-top:50px;">

<h1 class="heading">History</h1>
<h3 class="title">Topics</h3>

<div class="card-container">
<?php 
        $student = new User;
        $subject = $student->display_subject('History');
        $counter = 0;
        foreach($subject as $key => $value){
           if(!empty($subject)){
        ?>
    <div class="card" style="width:40rem!important;">
    <h3 style="font-size:20px; margin-bottom:9px;"><span><?php echo ++$counter;?>.</span><?php echo $value['topic_name']?></h3>
    <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="340" height="240" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                    <p><?php echo $value['topic_details']?></p>
    </div>
    <?php }}?>
</div>


</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="main.js"></script>
    </body>
</html>