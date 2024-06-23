<?php 
session_start();
include("projectinfo.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>


    <!-- header section starts  -->

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

    <!-- header section ends -->


    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="content">
            <h1>learn online from home</h1>
            <?php if(!isset($_SESSION['student_name'])){?>
            <a href="signuppage.php" style="display:inline; margin-bottom:10px;"><button>Sign Up</button></a>
            <a href="loginpage.php" style="display:inline;"><button>Log In</button></a>
            <?php }?>
        </div>

        <div class="box-container">
           <?php if(isset($_SESSION['student_name'])){?>
            <a href="subjectpage.php"><div class="box">
                <i class="fas fa-graduation-cap"></i>
                <h3>Subjects</h3>
                <p></p>
            </div></a>
            <?php }?>

            <a href="tutorialpage.php"><div class="box">
                <i class="fas fa-fire"></i>
                <h3>Tutorials</h3>
                <p></p>
            </div></a>
            <?php if(isset($_SESSION['student_name'])){?>
            <a href="dashboardpage.php"><div class="box">
                <i class="fas fa-award"></i>
                <h3>Dashboard</h3>
                <p></p>
            </div></a>
            <?php }?>

        </div>

    </section>

    <!-- home section ends -->

    
    <!-- teacher section starts  -->

    <section id="teacher" class="teacher">

        <h1 class="heading">Teachers</h1>
        <h3 class="title">Learn different topics</h3>

        <div class="card-container">
            <?php 
            $teacher = new User;
            $teachers = $teacher->select_teachers();
            foreach($teachers as $key => $value){
                if(!empty($teachers)){
            ?>
            <div class="card">
            <h3><?php echo $value['username']?></h3>
             <?php if(empty($value['photo'])){?>
                <img src="images/usericons.png" alt="">
                <?php }else{?>
                <img src="profile/<?php echo $value['photo'];?>" alt="">
                <?php }?>
            </div>
            <?php }}?>

            <!-- <div class="card">
            <h3>someone's name</h3>
                <img src="images/teacher2.jpg" alt="">
                <p>i love teaching</p>
            </div>

            <div class="card">
            <h3>someone's name</h3>
                <img src="images/teacher3.jpg" alt="">
                <p>i love teaching</p>
            </div> -->


        </div>


    </section>

    <section id="teacher" class="teacher">
         <?php if(isset($_SESSION['unique_id'])){?>
        <h1 class="heading">Students</h1>
        <h3 class="title">See different friends</h3>
        <?php }?>

        <div class="card-container">
            <?php 
            if(isset($_SESSION['unique_id'])){
            $teacher = new User;
            $teachers = $teacher->select_scholars($_SESSION['unique_id']);
            foreach($teachers as $key => $value){
                if(!empty($teachers)){
            ?>
           <a href="profilepage.php?scholar_id=<?php echo $value['unique_id'];?>"><div class="card scholar">
            <h3><?php echo $value['username']?></h3>
             <?php if(empty($value['photo'])){?>
                <img src="images/usericons.png" alt="">
                <?php }else{?>
                <img src="profile/<?php echo $value['photo'];?>" alt="">
                <?php }?>
            </div></a>
            <?php }}}?>

        </div>


    </section>


    <!-- teacher section ends -->

    <!-- review section starts  -->

    
    <!-- review section ends -->

    <!-- about section starts  -->


    


    <!-- about section ends -->

   

    <section class="footer">

        <div class="icons">
            <a href="https://web.facebook.com/" class="fab fa-facebook-f"></a>
            <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
        </div>

        <div class="credit"> All rights reserved.</div>

    </section>














    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- custom js file link  -->
    <script src="main.js"></script>


</body>

</html>