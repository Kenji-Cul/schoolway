<?php 
ob_start();
session_start();
if(!isset($_SESSION['student_email'])){
    header("Location:index.php");
}
include("projectinfo.php");
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Dashboard</title>  
      <link href="adminstyle.css" rel="stylesheet" type="text/css">
      <link href="subjectstyle.css" rel="stylesheet" type="text/css">
       
      <!--Font awesome link-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
         <div id="mysidenav" class="sidenav">
           <p class="logo"><span style="color:black;"><?php echo MY_APP_NAME;?></span></p>
           <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Dashboard</a>
           <a href="index.php" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Home</a>
           <a href="#" class="icon-a" id="bio"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Add Bio</a>
           <a href="tutorialpage.php" class="icon-a"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Tutorials</a>
           <a href="chatpage.php" class="icon-a"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Chat</a>
           <a href="subjectpage.php" class="icon-a"><i class="fa fa-shopping-bag icons"></i>&nbsp;&nbsp;Subjects</a>
           <?php if(isset($_SESSION['student_name'])){?><a href="logoutpage.php?id=<?php echo $_SESSION['unique_id']?>"><i class="fa fa-tasks icons"></i>Logout</a><?php }?>
         </div>

         <div id="main">
             <div class="head">
                 <div class="col-div-6">
                     <span style="font-size:30px; cursor:pointer; color: #1b203d;" class="nav">&#9776; Dashboard</span>
                     <span style="font-size:30px; cursor:pointer; color:#1b203d;" class="nav2">&#9776; Dashboard</span>
                 </div>

                 <div class="col-div-6">
                    <div class="profile"> 
                    <?php 
                     $teacher = new User;
                     $teacherpic = $teacher->select_studentprofile($_SESSION['student_email']);
                     foreach($teacherpic as $key => $value){
                       if(!empty($teacherpic)){
                    ?>
                   <?php if(empty($value['photo'])){?>
                    <img src="images/usericons.png"  style="border-radius:50%; height:5rem; width:5rem;border:2px solid blue;">
                    <?php }else{?>
                    <img src="profile/<?php echo $value['photo'];?>"  style="border-radius:50%; height:5rem; width:5rem; border:2px solid blue;">
                    <?php }?>
                       <?php }}?>
                        <p style="color:#1b203d;"><?php if(isset($_SESSION['student_name'])){
                    echo $_SESSION['student_name'];
                }else{
                    echo "Name";
                }?><span>Student</span></p></div>
                 </div>

                 <div class="clearfix"></div>
             </div>

             <div class="col-div-3">
                 <div class="box">
                     <p><?php $teacher = new User;
                             $teacherinfo = $teacher->no_videos();
                             echo $teacherinfo['count(topic_video)'];
                     ?><br><span>Tutorials</span></p>
                 </div>
             </div>

             <div class="col-div-3">
                 <div class="box">
                     <p>12<br><span>Subjects</span></p>
                 </div>
             </div>

             <div class="col-div-3">
                 <div class="box">
                     <p><?php 
echo date('h:i');?><br><span><?php echo date('jS M,Y');?></span></p>
                 </div>
             </div>


             <div class="col-div-3">
                 <div class="box">
                 <section>
                     <div class="contentBx">
                     <div class="formBx">
                         <?php 
                             if(!empty($_POST['upload'])){
                          $teacher = new User;
                          $teacherpic = $teacher->add_studentphoto($_SESSION['student_email']);
                             }
                         ?>
                     <form action="" method="POST" enctype="multipart/form-data">
                     <div class='inputBx' style="margin-bottom:8px;">
                          <label for='files'>Choose profile Picture</label>
                          <input type='file' name="profile" accept='image/*' id='files'>
                      </div>
                      <div class="inputBx">
                      <input type="submit" value='Upload' name='upload'>
                      </div>
                     </form>
                     </div>
                     </div>
                     </section>
                 </div>
             </div>

             <div class="clearfix"></div>
             <br><br>

             <div class="col-div-8">
                 <div class="box-8">
                 <section>
                     <div class="contentBx" style="margin-top:10px; margin-left:50px;" id="conbio">
                     <div class="formBx">
                     <?php 
                             if(!empty($_POST['bio'])){
                          $student = new User;
                          $studentinfo = $student->update_info($_POST['info'],$_SESSION['student_email']);
                             }
                         ?>
                     <form action="" method="POST">
                     <div class='inputBx'>
                         <textarea name="info" cols="45" rows="10"></textarea>
                      </div>
                      <div class="inputBx">
                      <input type="submit" value='Add Bio' name='bio'>
                      </div>
                     </form>
                     </div>
                     </div>
                     </section>
                 </div>
             </div>

             <div class="col-div-4">
               <div class="box-4">
                     <div class="content-box">
                         <h2>Bio</h2>
                     <p><span><?php  $teacher = new User;
                     $teacherpic = $teacher->select_studentprofile($_SESSION['student_email']);
                     foreach($teacherpic as $key => $value){
                         if(!empty($teacherpic)){
                     ?><?php if(!empty($value['bio'])){echo $value['bio'];}else{?><span>You have not added any information</span><?php }?>
                    </span>
                     <?php }}?>
               </div>
                 </div>
             </div>
  
             <div class="clearfix"></div>
         </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".nav").click(function(){
           $(".sidenav").css('width','70px');
           $("#main").css('margin-left','70px');
           $(".logo").css('visibility','hidden');
           $(".logo span").css('visibility','visible');
           $(".logo span").css('margin-left','-10px');
           $(".icon-a").css('visibility','hidden');
           $(".icons").css('visibility','visible');
           $(".icons").css('margin-left','-8px');
           $(".nav").css('display','none');
           $(".nav2").css('display','block');
        });

        $(".nav2").click(function(){
           $(".sidenav").css('width','300px');
           $("#main").css('margin-left','300px');
           $(".logo").css('visibility','visible');
           $(".logo span").css('visibility','visible');
           $(".icon-a").css('visibility','visible');
           $(".icons").css('visibility','visible');
           $(".nav").css('display','block');
           $(".nav2").css('display','none');
        });

        $("#conbio").hide();
        $("#bio").click(function(){
            $("#conbio").show();
        });
        });
    </script>
    </body>
    <?php ob_end_flush();?>
</html>