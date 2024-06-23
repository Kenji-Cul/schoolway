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
                <li><a href="#teacher"><?php if(isset($_SESSION['teacher_name'])){
                    echo $_SESSION['teacher_name'];
                }else{
                    echo "Name";
                }?></a></li>
                <?php if(isset($_SESSION['student_name'])){?><li><a href="teacherlogout.php">Logout</a></li><?php }?>
            </ul>
        </nav>

        <div class="fas fa-bars"></div>

    </header>
    
    <section id="teacher" class="teacher" style="margin-top:50px;">
        <div class="card-container">
            <?php 
                      $teacher = new User;
                      $teacherinfo = $teacher->select_students();
                      foreach($teacherinfo as $key => $value){
                          if(!empty($teacherinfo)){
                      ?>
            <div class="card">
            <p></p>
            <p></p>
            <h3><?php echo $value['username']?></h3>
            <?php if(empty($value['photo'])){?>
                        <img src="images/usericons.png"  style="border-radius:50%; height:10rem; width:10rem; 
                      margin-top:8px;">
                       <?php }else{?>
                        <img src="profile/<?php echo $value['photo'];?>"  style="border-radius:50%; height:10rem; width:10rem; 
                      margin-top:8px; display:block!important;">
                      <?php }?>
                       <h4 style="color:black; text-transform: lowercase; font-size: 12px;"><?php echo $value['email'];?></h4>
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