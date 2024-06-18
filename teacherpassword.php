<?php 
session_start();
include("projectinfo.php");
?>
<html>
 <head>
     <title>Login</title>
 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <style type="text/css">
*{
    margin:0;
    padding: 0;
    box-sizing: border-box;
}
body{
    background: rgb(219,226,226);
}
.row{
    background: white;
    border-radius: 30px;
    height:30em;
    box-shadow: 12px 12px 22px grey;
}
img{
    border-bottom-left-radius: 30px;
    border-top-left-radius: 30px;
    object-fit: cover;
}
.btn1{
    border:none;
    outline: none;
    height:50px;
    width:100%;
    background-color: black;
    color: white;
    border-radius: 4px;
    font-weight: bold;
}
.btn1:hover{
    background: white;
    border:1px solid;
    color: black;
}
#rowguy{
    height:35em;
}
 </style>
 </head>   
 <body>
<section class="Form my-4 mx-5"  id="first">
    <div class="container">
        <?php 
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(empty($_POST['pwd'])){
                $errormsg="<div class='alert alert-danger'>Password required to login</div>";
            }
            else{
                $student = new User;
                $userdetails=$student->select_teacher($_SESSION['teacher_email'],md5($_POST['pwd']));
                //var_dump($userdetails);
                  
                if(empty($userdetails)){
                    $errormsg="<div class='alert alert-danger'>Invalid login details try again</div>";
                }else{   
                    $_SESSION['teacher_id'] =$userdetails['teacher_id'];
                    $_SESSION['teacher_name'] = $userdetails['username'];
                    $_SESSION['teacher_email'] = $userdetails['email'];
                    $_SESSION['nameuser'] = "great123";
                    
                    $log="<div class='alert alert-success'><h3 align='center'>Login successful</h3></div>";
                header("Location: teacherpage.php");
            }
         }
        }
         function check_input($data){
            $data = trim($data);
            $data = strip_tags($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
     }
        ?>
        <?php 
         if(!empty($errormsg)){
             echo $errormsg;
         }if(!empty($log)){
             echo $log;
         }
        ?>
        <div class="row no-gutters">
            <div class="col-lg-5">
                <img src="images/schoolimage.jpg" alt="No Image" class="img-fluid" style="height:30em;">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="font-weight-bold py-3">Welcome Back</h1>
                <h4>Your password</h4>
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" name="pwd" value=""  class="form-control my-3 p-4" placeholder="********"> 
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="submit"  class="btn1  mb-4">Login</button>
                        </div>
                    </div>
                    <a href="changepassword.php">Forgot Password ?</a>
                    <p>Don't have an account ? <a href="teachersignup.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</section>




 </body>
</html>