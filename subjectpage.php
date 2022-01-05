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
        <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
        <style type="text/css">
            ul li{
                font-size:1.3em;
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

        <h1 class="heading">Subjects</h1>
        <h3 class="title">Your subjects</h3>

        <div class="card-container">

            <div class="card" id="click1">
            <p></p>
                <p></p>
                <a href="englishpage.php"><h3>English</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click2">
            <p></p>
            <p></p>
                <a href="mathematicspage.php"><h3>Mathematics</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click3">
            <p></p>
            <p></p>
                <a href="physicspage.php"><h3>Physics</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click4">
            <p></p>
            <p></p>
                <a href="chemistrypage.php"><h3>Chemistry</h3></a>
                <p></p>
                <p></p>
            </div>

        </div>


    </section>






  

    <section id="teacher" class="teacher" style="margin-top:50px;">
        <div class="card-container">

            <div class="card" id="click5">
            <p></p>
                <p></p>
                <a href="biologypage.php"><h3>Biology</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click6">
            <p></p>
            <p></p>
                <a href="geographypage.php"><h3>Geography</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click7">
            <p></p>
            <p></p>
                <a href="furthermathspage.php"><h3>Further Mathematics</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click8">
            <p></p>
            <p></p>
                <a href="historypage.php"><h3>History</h3></a>
                <p></p>
                <p></p>
            </div>

        </div>


    </section>




      
    <section id="teacher" class="teacher" style="margin-top:50px;">
        <div class="card-container">

            <div class="card" id="click9">
            <p></p>
                <p></p>
                <a href="technicalpage.php"><h3>Technical Drawing</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click10">
            <p></p>
            <p></p>
                <a href="dataprocessingpage.php"><h3>Data Processing</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click11">
            <p></p>
            <p></p>
                <a href="fisherypage.php"><h3>Fishery</h3></a>
                <p></p>
                <p></p>
            </div>

            <div class="card" id="click12">
            <p></p>
            <p></p>
                <a href="foodpage.php"><h3>Food & Nutrition</h3></a>
                <p></p>
                <p></p>
            </div>

        </div>


    </section>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="main.js"></script>
    </body>
</html>