<?php 
session_start();
include("projectinfo.php");
?>
<!DOCTYPE html>
<html>
    <head>
      <title></title>  
      <link href="adminstyle.css" rel="stylesheet" type="text/css">
      <link href="subjectstyle.css" rel="stylesheet" type="text/css">
       
      <!--Font awesome link-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body style="height:1200px;">
        <div class="container-fluid">
         <div id="main">
             <div class="head">
                 <div class="col-div-6">
                    <div class="profile"> 
                   <h3><span>All Students</span></h3></p></div>
                 </div>

                 <div class="clearfix"></div>
             </div>




 

             <div class="clearfix"></div>
             <br><br>

             <div class="col-div-4" style="height:900px; margin-left:10px;">
               <div class="box-4" style="height:900px; margin-left:10px;">
                     <div class="content-box">
                      <h4>Profile Pic</h4>
                      <?php 
                      $teacher = new User;
                      $teacherinfo = $teacher->select_students();
                      foreach($teacherinfo as $key => $value){
                          if(!empty($teacherinfo)){
                      ?>
                     <?php if(empty($value['photo'])){?>
                      <img src="images/usericons.png"  style="border-radius:50%; height:4rem; width:5rem; 
                      margin-top:8px;">
                       <?php }else{?>
                        <img src="profile/<?php echo $value['photo'];?>"  style="border-radius:50%; height:4rem; width:5rem; 
                      margin-top:8px; display:block!important;">
                      <?php }?>
                       <h5 style="margin-top:11px;"><?php echo $value['username']?></h5> <span><?php echo $value['email'];?></span>
                      <?php }}?>
               </div>
                 </div>
             </div>


             <div class="col-div-8" style="height:900px; width:65%;">
                 <div class="box-8" style="height:900px;  width:65%;">
                     <div class="content-box">
                     <h4>Information</h4>
                     <?php 
                      $teacher = new User;
                      $teacherinfo = $teacher->select_students();
                      foreach($teacherinfo as $key => $value){
                          if(!empty($teacherinfo)){
                      ?>
                       <h5 style="margin-top:11px;"><?php echo $value['username']?></h5> <span><?php echo $value['email'];?></span>
                     <?php }}?>
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
        });
    </script>
    </body>
</html>