<?php 
session_start();
if(!isset($_SESSION['teacher_email'])){
    header("Location:index.php");
}
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
        <link href="subjectstyle.css" rel="stylesheet" type="text/css">
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
                <li><a href="#teacher"><?php if(isset($_SESSION['teacher_name'])){
                    echo $_SESSION['teacher_name'];
                }else{
                    echo "Name";
                }?></a></li>
                <?php if(isset($_SESSION['teacher_name'])){?><li><a href="teacherlogout.php">Logout</a></li><?php }?>
            </ul>
        </nav>

        <div class="fas fa-bars"></div>

    </header>
    
    <section id="teacher" class="teacher" style="margin-top:50px;">
        <div class="card-container">
            <?php 
                      $teacher = new User;
                      $teacherinfo = $teacher->select_content();
                      foreach($teacherinfo as $key => $value){
                          if(!empty($teacherinfo)){
                      ?>
            <div class="card">
            <p><?php echo $value['topic_name']?></p>
            <p></p>
            <a href="updatepage.php?subject_id=<?php echo $value['subject_id'];?>"><h3 style="color:black; cursor:pointer;">Update</h3></a>
                <a href="deletepage.php?subjectid=<?php echo $value['subject_id'];?>"><h3 style="color:red; cursor:pointer;">Delete</h3></a>
            <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="340" height="240" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
            </div>
            <?php }}?>

        </div>


    </section>
    </body>
</html>