<?php 
session_start();
if(!isset($_SESSION['student_email'])){
    header("Location:index.php");
}
include("projectinfo.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="chat.css">
        <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
        <style type="text/css">
            body{
                background-color: #272c4a;
            }
            ul li{
                font-size:1.3em;
            }
            form{
            display: flex;
        }
        input{
            font-size: 1.2rem;
            padding: 10px;
            margin: 10px 5px;
            appearance: none;
            -webkit-appearance: none;
            border: 2px solid black;
            border-radius: 5px;
        }
        #message{
            flex: 2;
        }
        .messages{
            height: 63vh;
            padding: 10px;
            background-color: #333;
            display: flex;
            border-radius: 10px 10px 0 0;
        }
        .friends .details .status-dot.offline {
    color: #ccc;
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
   
<section style="margin-top:100px;">
     <div class="container">
         <div class="col-div-12">
             <div class="img">
             <div class="search">
                  <span class="text">Search for a user</span>
                  <input type="text" placeholder="Enter name to search....">
                  <button><i class="fas fa-search"></i></button>
              </div>
            </div>
         </div>
     </div>
</section>


<div id="mysidenav" class="sidenav">
<div class="content-box">
                      <h4>Friends</h4>
                      <div class="content">
                      
                     </div>
         </div>
         </div>

<script src="javascript/chat.js"></script>
    </body>
</html>