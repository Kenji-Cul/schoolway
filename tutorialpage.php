<?php 
session_start();
include("projectinfo.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <link rel="stylesheet" href="style.css">
        <style type="text/css">
            .teacher .card-container .card {
    padding: 2rem;
    margin: 2rem;
    background: #fff;
    text-align: center;
    width: 40rem;
    box-shadow: 0 .3rem .5rem rgba(0, 0, 0, .3);
}
        </style>
    </head>
    <body>

    <header>

        <a href="index.php" class="logo"><i class="fas fa-graduation-cap"></i><?php echo MY_APP_NAME?></a>

        <nav class="navbar">
            <ul>
                <li><a href="index.php" class="active" style="color:#3204ff;">home</a></li>
                <li><a href="#teacher"><?php if(isset($_SESSION['student_name'])){
                    echo $_SESSION['student_name'];
                }else{
                    echo "Name";
                }?></a></li>
                <li><a href="#teacher"><?php if(isset($_SESSION['student_name'])){
                    echo $_SESSION['student_class'];
                }else{
                    echo "Class";
                }?></a></li>
                <?php if(isset($_SESSION['student_name'])){?><li><a href="logoutpage.php?id=<?php echo $_SESSION['unique_id']?>">Logout</a></li><?php }?>
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
    
    <section id="teacher" class="teacher" style="margin-top:50px;">

        <h1 class="heading">Tutorials</h1>
        <h3 class="title">Your subjects</h3>

        <div class="card-container">
            <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('English');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
                <p></p>
                <h3><?php echo $value['subject_name']?></h3>
                <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="340" height="240" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }elseif(empty($subjectinfo)){ ?>
                <h1>No videos for now</h1>
           <?php }}?>

            <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Mathematics');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
            <p></p>
            <h3><?php echo $value['subject_name']?></h3>
            <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="300" height="200" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>


            <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Physics');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
            <p></p>
            <h3><?php echo $value['subject_name']?></h3>
            <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="300" height="200" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>


        </div>


    </section>

    <section id="teacher" class="teacher" style="margin-top:50px;">
        <div class="card-container">
        <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Biology');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
                <p></p>
                <h3><?php echo $value['subject_name']?></h3>
                <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="300" height="200" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>

            
            <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Geography');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
            <p></p>
            <h3><?php echo $value['subject_name']?></h3>
            <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="300" height="200" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>


            <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Further Mathematics');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
            <p></p>
            <h3><?php echo $value['subject_name']?></h3>
            <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="300" height="200" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>


        </div>


    </section>

    <section id="teacher" class="teacher" style="margin-top:50px;">
        <div class="card-container">
           

        <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Technical Drawing');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
                <p></p>
                <h3><?php echo $value['subject_name']?></h3>
                <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="300" height="200" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>


            <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Data Processing');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
            <p></p>
            <h3><?php echo $value['subject_name']?></h3>
            <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="300" height="200" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>


            <?php 
             $subject = new User;
             $subjectinfo = $subject->select_topicname('Fishery');
             foreach($subjectinfo as $key => $value){
                if(!empty($subjectinfo)){
            ?>
            <div class="card">
            <p></p>
            <p></p>
            <h3><?php echo $value['subject_name']?></h3>
            <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="340" height="240" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <p></p>
                <p></p>
            </div>
            <?php }}?>

        </div>


    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="main.js"></script>
    </body>
</html>