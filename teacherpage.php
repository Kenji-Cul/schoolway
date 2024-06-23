<?php 
ob_start();
session_start();
if(!isset($_SESSION['teacher_email'])){
    header("Location:index.php");
}
include("projectinfo.php");
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Teacher</title>  
      <link href="adminstyle.css" rel="stylesheet" type="text/css">
      <link href="subjectstyle.css" rel="stylesheet" type="text/css">
       
      <!--Font awesome link-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <style type="text/css">
          .btn1{
    border:none;
    outline: none;
    height:50px;
    width:50%;
    background-color: black;
    color: white;
    border-radius: 4px;
    font-weight: bold;
}
.form-control{
    border:none;
    outline: none;
    height:30px;
    width:50%;
    background-color: white;
    color: white;
    border-radius: 4px;
    font-weight: bold;
    margin-bottom: 20px;
}
form{
    margin:auto;
}
.btn1:hover{
    background: white;
    border:1px solid;
    color: black;
}
      </style>
    </head>
    <body>
         <div id="mysidenav" class="sidenav">
           <p class="logo"><span style="color:black;"><?php echo MY_APP_NAME;?></span></p>
           <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Dashboard</a>
           <a href="studentsallpage.php" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;Students</a>
           <a href="#" class="icon-a" id="subject"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Add Details</a>
           <a href="updatedelete.php" class="icon-a" id="subject"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Update Details</a>
           <a href="teacherlogout.php" class="icon-a" id="subject"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Log Out</a>
         </div>

         <div id="mainguy">
         <div id="main">
             <div class="head">
                 <div class="col-div-6">
                     <span style="font-size:30px; cursor:pointer; color:#1b203d;" class="nav">&#9776; Dashboard</span>
                     <span style="font-size:30px; cursor:pointer; color:#1b203d;" class="nav2">&#9776; Dashboard</span>
                 </div>

                 <div class="col-div-6">
                    <div class="profile"> 
                    <?php 
                     $teacher = new User;
                     $teacherpic = $teacher->select_profile($_SESSION['teacher_email']);
                     foreach($teacherpic as $key => $value){
                       if(!empty($teacherpic)){
                    ?>
                    <?php if(empty($value['photo'])){?>
                    <img src="images/usericons.png"  style="border-radius:50%; height:5rem; width:5rem; object-fit: cover;">
                    <?php }else{?>
                    <img src="profile/<?php echo $value['photo'];?>"  style="border-radius:50%; height:5rem; width:5rem; border:2px solid blue; object-fit: cover;">
                    <?php }?>
                       <?php }}?>
                        <p style="color:black;"><?php if(isset($_SESSION['teacher_email'])){
                    echo $_SESSION['teacher_name'];
                }else{
                    echo "Name";
                }?><span>Teacher</span></p></div>
                 </div>

                 <div class="clearfix"></div>
             </div>

             <div class="col-div-3">
                 <div class="box">
                     <p><?php $teacher = new User;
                             $teacherinfo = $teacher->no_students();
                             echo $teacherinfo['count(username)'];
                     ?><br><span>Students</span></p>
                     <i class="fa fa-users box-icon"></i>
                 </div>
             </div>

             <div class="col-div-3">
                 <div class="box">
                     <p>12<br><span>Subjects</span></p>
                     <i class="fa fa-list box-icon"></i>
                 </div>
             </div>

             <div class="col-div-3">
                 <div class="box">
                     <p><?php $teacher = new User;
                             $teacherinfo = $teacher->no_videos();
                             echo $teacherinfo['count(topic_video)'];
                     ?><br><span>Videos</span></p>
                     <i class="fa fa-shopping-bag box-icon"></i>
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
                          $teacherpic = $teacher->add_photo($_SESSION['teacher_email']);
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
                 <div class="box-8" id="contentbox">
                 <?php 
                if(!empty($_POST['addingdetail'])){
                   if(empty($_POST['select'])){
                           $errormsg = "<h3>You have not selected any subject</h3>";
                    }else if(empty($_POST['topic'])){
                        $errormsg = "<h3>You have not selected any topic</h3>";
                 }
                    else if(empty($_POST['details'])){
                        $errormsg = "<h3>You have not added details</h3>";
                    }
                    else{
                        $subject = new User;
            $subjectname = $subject->add_details($_POST['select'],$_POST['topic'],$_POST['details']);
                        echo $subjectname;
                        header("Location:teacherpage.php");
                    }
                }
               ?>
                     <div class="content-box" >
                         <p><span id="click">View All Subjects</span></p>
                         <?php if(isset($errormsg)){echo $errormsg;}?>
                         <section id="detailsbox">
                         <div class="contentBx" id="content">
           <div class='formBx'>
                         <form action='' method="POST" enctype="multipart/form-data">
                      <div class='inputBx'>
                          <span>Subject Name</span>
                          <select name="select" id="">
                              <option value="">Choose Subject</option>
                              <option value="English">English</option>
                              <option value="Mathematics">Mathematics</option>
                              <option value="Chemistry">Chemistry</option>
                              <option value="Physics">Physics</option>
                              <option value="Biology">Biology</option>
                              <option value="Technical Drawing">Technical Drawing</option>
                              <option value="Food & Nutrition">Food & Nutrition</option>
                              <option value="Fishery">Fishery</option>
                              <option value="Data Processing">Data Processing</option>
                              <option value="Further Mathematics">Further Mathematics</option>
                              <option value="Geography">Geography</option>
                              <option value="History">History</option>
                          </select>
                      </div>

                      <div class='inputBx'>
                          <span>Topic Name</span>
                          <input type='text' name="topic" value="<?php if(isset($_POST['topic'])){
                              echo $_POST['topic'];
                          }?>">
                      </div>

                      <div class='inputBx'>
                          <label for='file'>Add Video</label>
                          <input type='file' name="image" accept='video/*' id='file'>
                      </div>

                      <div class='inputBx'>
                          <span>Topic details</span>
                          <input type='text' name="details" value="<?php if(isset($_POST['details'])){
                              echo $_POST['details'];
                          }?>">
                      </div>

                      <div class='inputBx'>
                          <input type="submit" value='Add Details' name='addingdetail'>
                      </div>
                  </form>
           </div>
                         </div>
                         </section>

                    
                        
                         <br>
                         <table id="subjectsbox">
                             <tr>
                                 <th>Subject</th>
                                 <th>Subject</th>
                                 <th>Subject</th>
                             </tr>
                             <tr>
                                 <td>English</td>
                                 <td>Mathematics</td>
                                 <td>Chemistry</td>
                             </tr>
                             <tr>
                                 <td>Physics</td>
                                 <td>Biology</td>
                                 <td>Techinical Drawing</td>
                             </tr>
                             <tr>
                                 <td>Food & Nutrition</td>
                                 <td>Fishery</td>
                                 <td>Data Processing</td>
                             </tr>
                             <tr>
                                 <td>Further Maths</td>
                                 <td>Geography</td>
                                 <td>History</td>
                             </tr>
                         </table>
                     </div>
                 </div>
             </div>

             <div class="col-div-4">
               <div class="box-4">
                     <div class="content-box">
                     
                    
               </div>
                 </div>
             </div>
  
             <div class="clearfix"></div>
         </div>
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

       $("#detailsbox").hide()
        $("#subject").click(function(){
            $("#detailsbox").show()
        });

        $("#subjectsbox").hide();
        $("#click").click(function(){
            $("#subjectsbox").show();
        });

        //$("#main").hide();
        });
    </script>
    </body>
    <?php ob_end_flush();?>
</html>