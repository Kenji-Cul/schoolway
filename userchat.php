<?php 
session_start();
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
        button {
    width: 55px;
    border: 2px solid black;
    outline: none;
    background: black;
    color: white;
    font-size: 22px;
    cursor: pointer;
    border-radius: 0 5px 5px 0;
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
      <div class="sidenav">
        <div id="main" style="margin-top:7rem; margin-left:0px!important;">
        <?php 
        $emailid = $_GET['unique_id'];
         $student = new User;
         $stud = $student->select_user($emailid);
        ?>
        <div class="messages" style="height:100px;">
        <div class="client">
           <?php if(empty($stud['photo'])){?>
            <img src="images/usericons.png"  style="border-radius:50%; height:4rem; width:4rem;">
            <?php }else{?>
                           <img src="profile/<?php echo $stud['photo']?>" alt="" style="border-radius:50%; width:6rem; height:6rem;">
                           <?php }?>
                           <div class="client-info"></div>
                           <div>
                           <h1 style="color:white; margin-left:8px; font-size:25px;"><?php echo $stud['username'];?></h1>
                           <p style="color:white; margin-left:10px; font-size:16px; color:green;"><?php echo $stud['status'];?></p>
                           </div>
                       </div> 
        </div>
        <div class="chat" style="height:60vh;">
        <div class="chatting">
       
            </div>
        </div>
    <form class="typing-area">
        <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'];?>" hidden>
        <input type="text" name="incoming_id" value="<?php echo $stud['unique_id'];?>" hidden>
        <input type="text" name="message" class="message" id="message" placeholder="Type a message here...">
        <button><i class="fab fa-telegram-plane"></i></button>
    </form>
        </div>
        </div>
<script src="javascript/userschat.js"></script>
    </body>
</html>