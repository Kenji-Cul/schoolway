<?php 
include("projectinfo.php");
?>
<html>
 <head>
     <title>Signup</title>
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

<section class="Form my-4 mx-5" id="third">
    <div class="container">
    <?php 
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(empty($_POST['email'])){
                    $errormsg="<div class='alert alert-danger'>Please input your email</div>";
                }else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])){
                        $errormsg = "<div class='alert alert-danger'>You have entered an invalid email format</div>";
                    }
                if(empty($_POST['password']) || $_POST['password']==""){
                    $errormsg="<div class='alert alert-danger'>Please input your password</div>";
                }
                else if(strlen($_POST['password']) <= 8){
                   $errormsg = "<div class='alert alert-danger'>Password must be more than 8 characters</div>";
                }else if(!preg_match("#[0-9]+#",$_POST['password'])){
                    $passworderror = "<div class='alert alert-danger'>Password must contain at least 1 number</div>";
                }else if(!preg_match("#[A-Z]+#",$_POST['password'])){
                    $errormsg = "<div class='alert alert-danger'>Password must contain at least 1 Capital letter</div>";
                }
                else if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$_POST['password'])){
                    $errormsg = "<div class='alert alert-danger'>Password must contain a special character</div>";
                }
                else if(empty($_POST['name']) || $_POST['name']== ""){
                    $errormsg="<div class='alert alert-danger'>Please input your username</div>";
                }
                else if(empty($_POST['class']) || $_POST['class']== ""){
                    $errormsg="<div class='alert alert-danger'>Please choose your class</div>";
                }else{
                    $student = new User;
                    $studentdetails = $student->createUser(check_input($_POST['name']),check_input($_POST['email']),check_input($_POST['password']),check_input($_POST['class']));
                    echo $studentdetails;
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
            <?php if(isset($errormsg)){echo $errormsg;}?>
        <div class="row no-gutters" id="rowguy">
            <div class="col-lg-5">
                <img src="images/schoolimage.jpg" alt="No Image" class="img-fluid" style="height:35em;">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1 class="font-weight-bold py-3">Sign Up</h1>
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" name="name" value="<?php if(isset($_POST['name'])){
                                echo $_POST['name'];
                            }?>"  class="form-control my-3 p-4" placeholder="Your Name"> 
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="email" name="email" value="<?php if(isset($_POST['email'])){
                                echo $_POST['email'];
                            }?>"  class="form-control my-3 p-4" placeholder="Email Address"> 
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" name="password" value=""  class="form-control my-3 p-4" placeholder="Your Password"> 
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <select name="class" class="form-control my-3" value="
                            <?php if(isset($_POST['class'])){
                                echo $_POST['class'];
                            }?>">
                              <option value="">--Choose your class--</option>
                                <option value="JSS1">JSS1</option>
                                <option value="JSS2">JSS2</option>
                                <option value="jSS3">JSS3</option>
                                <option value="SS1">SS1</option>
                                <option value="SS2">SS2</option>
                                <option value="SS3">SS3</option>
                            </select>
                        </div>
                    </div>
                      
                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="submit" class="btn1  mb-4">Sign Up</button>
                        </div>
                    </div>
                    <span>Already Signed Up?</span><a href="loginpage.php">Login Here</a>
                </form>
            </div>
        </div>
    </div>
</section>

 </body>
</html>