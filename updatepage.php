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
        <link rel="stylesheet" href="adminstyle.css">
        <style type="text/css">
            .teacher .card-container .card {
    padding: 2rem;
    margin: 2rem;
    background: #fff;
    text-align: center;
    width: 70rem;
    box-shadow: 0 .3rem .5rem rgba(0, 0, 0, .3);
}
section .contentBx .formBx .inputBx input {
    width: 100%;
    padding: 4px 4px;
    outline: none;
    font-weight: 400;
    border: 2px solid #607d8b;
    font-size: 16px;
    letter-spacing: 1px;
    color: #607d8b;
    background: transparent;
    border-radius: 30px;
    margin-bottom: 12px;
}
section .contentBx .formBx .inputBx input[type="submit"] {
    background: black;
    color: #fff;
    outline: none;
    border: none;
    font-weight: 500;
    cursor: pointer;
}

section .contentBx .formBx .inputBx input[type="submit"]:hover {
    background: whitesmoke;
    color: black;
    border: 2px solid black;
}
        </style>
    </head>
    <body>

    <header>

        <a href="index.php" class="logo"><i class="fas fa-graduation-cap"></i><?php echo MY_APP_NAME?></a>

        <nav class="navbar">
            <ul>
                <li><a href="#teacher"><?php if(isset($_SESSION['teacher_name'])){
                    echo $_SESSION['teacher_name'];
                }else{
                    echo "Name";
                }?></a></li>
                <?php if(isset($_SESSION['teacher_name'])){?><li><a href="teacherlogout.php">Logout</a></li><?php }?>
            </ul>
        </nav>

        <div class="fas fa-bars"></div>

    </header>
    
    <section id="teacher" class="teacher" style="margin-top:50px;">

        <h1 class="heading">Update</h1>

        <div class="card-container">
            <div class="card">
            <section>
                     <div class="contentBx">
                     <div class="formBx">
                         <?php 
                          $subjectid = $_GET['subject_id'];
                             if(!empty($_POST['update'])){
                          $teacher = new User;
                          $teacherpic = $teacher->update_subject($_POST['subname'],$_POST['topname'],$_POST['details'],$subjectid);
                             }
                         ?>
                     <form action="" method="POST">
                         <?php 
                         $teacher = new User;
                         $teacherinfo = $teacher->select_subname($subjectid);
                         foreach($teacherinfo as $key => $value){
                             if(!empty($teacherinfo)){
                         ?>
                     <div class='inputBx'>
                          <input type='text' name="subname" value="<?php echo $value['subject_name'];?>">
                      </div>

                      <div class='inputBx'>
                          <input type='text' name="topname" value="<?php echo $value['topic_name'];?>">
                      </div>

                      <div class='inputBx'>
                          <input type='text' name="details" value="<?php echo $value['topic_details'];?>">
                      </div>
                      <div class="inputBx">
                      <input type="submit" value='Update' name='update'>
                      </div>
                     </form>
                     </div>
                     </div>
                     </section>
                <?php if(empty($value['topic_video'])){?>
                    <h4>No videos for now</h4>
                    <?php }else{?>
                    <video width="340" height="240" controls>
                        <source src="uploads/<?php echo $value['topic_video'];?>" type="video/mp4">
                    <?php }?>
                <div><h4><?php echo $value['topic_details'];?></h4></div>
                <p></p>
            </div>
<?php }else{?>
    <h1>No more items on your app</h1>
<?php }}?>

        </div>


    </section>

    

    </body>
</html>