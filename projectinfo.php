<?php 
//define class for the users

/**
 * Author : Teibo Gideon
 * Program : School Website
 * Date : December 20, 2021
 */

 #include constants
 include("connectiondb.php");

 class User{
     var $username;
     var $email;
     var $class;
     var $password;
     var $dbcon;

     function __construct(){
         //creating of the object
         $this->dbcon = new MySqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
         if($this->dbcon->connect_error){
            die("Connection failed: ". $this ->dbcon-> connect_error);
         }else{
             //echo "connected successfully";
         }
     }

     function createUser($username,$email,$password,$class){
         $password = md5($password);
         $status = "Active Now";
         $unique_id = rand(time(),10000000);
         //write the query
         $sql = "INSERT INTO user(username,class,status,unique_id,email,password) VALUES('{$username}','{$class}','{$status}','{$unique_id}','{$email}','{$password}')";
         $result = $this->dbcon->query($sql);

         //check if the connection runs successfully
         if($this->dbcon->affected_rows==1){
             session_start();
             session_unset();
             $_SESSION['student_id'] = $this->dbconnect ->insert_id;
             $_SESSION['student_name'] = $username;
             $_SESSION['student_class'] = $class;
             $_SESSION['student_email'] = $email;
             $_SESSION['unique_id'] = $unique_id;
             $_SESSION['nameuser'] = "great123";
            header("Location:index.php");
            exit;
         }else{
             echo "<div class='alert alert-danger'><h3>Email address already exists</h3></div>";//$this->dbcon->error;
         }
     }

     function login($email,$password){
        $pwd=md5($password);
       //write the query
       $sql = "SELECT * FROM user WHERE email='$email' AND password='$pwd'";
    
       $result =$this->dbcon->query($sql);
       $row = $result->fetch_assoc();
       if($result->num_rows == 1){
          return $row;
       }else{
           return $row;
       }
    }

     function userLogin($email){
        // $pwd="$password";
       //write the query
       $sql = "SELECT * FROM user WHERE email='$email'";
       //var_dump($sql);
       $result =$this->dbcon->query($sql);
    $row = $result->fetch_assoc();
       if($result->num_rows == 1){
          return $row;
       }else{
           return $row;
       }
    }

    function select_password($email,$password){
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result =$this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
           return $row;
        }else{
            return $row;
        }
    }

    function createTeacher($username,$email,$password){
        $password = md5($password);
        //write the query
        $sql = "INSERT INTO teacher(username,email,password) VALUES('$username','$email','$password')";
        $result = $this->dbcon->query($sql);

        //check if the connection runs successfully
        if($this->dbcon->affected_rows==1){
            echo "<div class='alert alert-success'><h3 align='center'>You have registered successfully</h3></div>";
        }else{
            echo "<div class='alert alert-danger'><h3>Email address already exists</h3></div>";
        }
    }

    function teacherLogin($email){
        // $pwd="$password";
       //write the query
       $sql = "SELECT * FROM teacher WHERE email='$email'";
    //    var_dump($sql);
       $result =$this->dbcon->query($sql);
    $row = $result->fetch_assoc();
       if($result->num_rows == 1){
          return $row;
       }else{
           return $row;
       }
    }

    function select_teacher($email,$password){
        $sql = "SELECT * FROM teacher WHERE email='$email' AND password='$password'";
        $result =$this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
           return $row;
        }else{
            return $row;
        }
    }

    function addsubname($subname){
      $sql = "INSERT INTO subjectname(subject_name) VALUES('$subname')";
      $result = $this->dbcon->query($sql);

        //check if the connection runs successfully
        if($this->dbcon->affected_rows==1){
            echo "<h3 align='center'>Subject added successfully</h3>";
        }else{
            echo $this->dbcon->error;  
        }
    }

    function add_details($subjectname,$topicname,$topicdetails){
        // create variables for image
	$filename = $_FILES['image']['name'];
	$filesize = $_FILES['image']['size'];
	$filetype = $_FILES['image']['type'];
	$file_error = $_FILES['image']['error'];
	$filetmp = $_FILES['image']['tmp_name'];
  // validate image
	if($file_error > 0){
		$error = "You have not selected a file";
		return $error;
	}

	if($filesize > 41943040){
		$error = "Your file should be less than 40mb";
		return $error;
	}

	$extensions = array("mp4","gif", "png", "jpeg", "svg", "jpg");
	$file_ext = explode(".",$filename);
	$file_ext = end($file_ext);

	if(!in_array(strtolower($file_ext), $extensions)){
		$error = $file_ext."File format not supported";
		return $error;
	}

	//upload image
	$folder = "uploads/";
	$newfilename = time().rand().".".$file_ext;
	$destination = $folder.$newfilename;
    if(move_uploaded_file($filetmp, $destination)){
        $sql = "INSERT INTO subject(subject_name,topic_name,topic_video,topic_details) VALUES('{$subjectname}','{$topicname}','{$newfilename}','{$topicdetails}')";
        $result = $this->dbcon->query($sql);
  
          //check if the connection runs successfully
          if($this->dbcon->affected_rows==1){
              echo "<h3 align='center'>Subject added successfully</h3>";
          }else{
              echo   "<h3 align='center'>There is an error with your file</h3>";//$this->dbcon->error;
          }
    }
}

  function display_subject($subname){
      $sql = "SELECT * FROM subject WHERE subject_name='$subname'";
      $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
  }

  function no_students(){
      $sql = "SELECT count(username) FROM user";
      $result = $this->dbcon->query($sql);
		$row = $result->fetch_assoc();
   if($result->num_rows == 1){
      return $row;
   }else{
   	return $row;
   }
  }

  function no_videos(){
    $sql = "SELECT count(topic_video) FROM subject";
    $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
 if($result->num_rows == 1){
    return $row;
 }else{
     return $row;
 }
}

 function select_topic($subject_id){
     $sql = "SELECT * FROM subject WHERE subject_id='$subject_id'";
     $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}

 }

 function select_topicname($subject_name){
    $sql = "SELECT * FROM subject WHERE subject_name='$subject_name' order by rand() LIMIT 1";
    $result = $this->dbcon->query($sql);
   $rows = array();
       if($this->dbcon->affected_rows > 0){
           while($row = $result->fetch_assoc()){
               $rows[] = $row;
           }
           return $rows;
       }else{
           return $rows;
       }
}

 function add_photo($photo){
    $filename = $_FILES['profile']['name'];
	$filesize = $_FILES['profile']['size'];
	$filetype = $_FILES['profile']['type'];
	$file_error = $_FILES['profile']['error'];
	$filetmp = $_FILES['profile']['tmp_name'];
  // validate image
	if($file_error > 0){
		$error = "You have not selected a file";
		return $error;
	}

	if($filesize > 2097152){
		$error = "Your file should be less than 2mb";
		return $error;
	}

	$extensions = array("gif", "png", "jpeg", "svg", "jpg");
	$file_ext = explode(".",$filename);
	$file_ext = end($file_ext);

	if(!in_array(strtolower($file_ext), $extensions)){
		$error = $file_ext."File format not supported";
		return $error;
	}

	//upload image
	$folder = "profile/";
	$newfilename = time().rand().".".$file_ext;
	$destination = $folder.$newfilename;
    if(move_uploaded_file($filetmp, $destination)){
     $sql = "UPDATE teacher SET photo='$newfilename' WHERE email='$photo'";
     $result = $this->dbcon->query($sql);
  
          //check if the connection runs successfully
          if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
          }else{
            //   echo  //$this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
 }
}

 function select_profile($email){
   $sql ="SELECT * FROM teacher WHERE email ='$email'";
   $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    

    function add_studentphoto($photo){
        $filename = $_FILES['profile']['name'];
        $filesize = $_FILES['profile']['size'];
        $filetype = $_FILES['profile']['type'];
        $file_error = $_FILES['profile']['error'];
        $filetmp = $_FILES['profile']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload image
        $folder = "profile/";
        $newfilename = time().rand().".".$file_ext;
        $destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $destination)){
         $sql = "UPDATE user SET photo='$newfilename' WHERE email='$photo'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
              }else{
                //   echo  //$this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     }
    }

    function select_studentprofile($email){
        $sql ="SELECT * FROM user WHERE email ='$email'";
        $result = $this->dbcon->query($sql);
         $rows = array();
             if($this->dbcon->affected_rows > 0){
                 while($row = $result->fetch_assoc()){
                     $rows[] = $row;
                 }
                 return $rows;
             }else{
                 return $rows;
             }
         }

         function select_studentid($id){
            $sql ="SELECT * FROM user WHERE unique_id ='$id'";
            $result = $this->dbcon->query($sql);
             $rows = array();
                 if($this->dbcon->affected_rows > 0){
                     while($row = $result->fetch_assoc()){
                         $rows[] = $row;
                     }
                     return $rows;
                 }else{
                     return $rows;
                 }
             }
     
     function select_students(){
         $sql = "SELECT * FROM user";
         $result = $this->dbcon->query($sql);
         $rows = array();
             if($this->dbcon->affected_rows > 0){
                 while($row = $result->fetch_assoc()){
                     $rows[] = $row;
                 }
                 return $rows;
             }else{
                 return $rows;
             }

     }

     function select_content(){
        $sql = "SELECT * FROM subject";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }

    }

    function update_subject($name,$topic,$detail,$subject){
        $sql = "UPDATE subject SET subject_name='$name',topic_name='$topic',topic_details='$detail' WHERE subject_id='$subject'";
        $result = $this->dbcon->query($sql);
	if($result){
             return "<div class='alert alert-success'>Product updated successfully</div>";
 	}else{
 		return $this->dbcon->error;   
 	}
    }

    function select_subname($subjectid){
        $sql ="SELECT * FROM subject WHERE subject_id ='$subjectid'";
        $result = $this->dbcon->query($sql);
         $rows = array();
             if($this->dbcon->affected_rows > 0){
                 while($row = $result->fetch_assoc()){
                     $rows[] = $row;
                 }
                 return $rows;
             }else{
                 return $rows;
             }
         }

         function delete_subject($subjectid){
            $sql ="DELETE FROM subject WHERE subject_id ='$subjectid'";
            $result = $this->dbcon->query($sql);
            if($result){
                return "<div class='alert alert-success'>Product deleted successfully</div>";
        }else{
            return $this->dbcon->error;   
        }
             }

       function select_teachers(){
           $sql = "SELECT * FROM teacher order by rand() LIMIT 3";
           $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}

       }

       function select_scholars($uniqueid){
        $sql = "SELECT * FROM user WHERE NOT unique_id = '{$uniqueid}' order by rand() LIMIT 4";
        $result = $this->dbcon->query($sql);
 $rows = array();
     if($this->dbcon->affected_rows > 0){
         while($row = $result->fetch_assoc()){
             $rows[] = $row;
         }
         return $rows;
     }else{
         return $rows;
     }

    }

       function select_friends($user_id){
        $sql = "SELECT * FROM friends WHERE user_id = '{$user_id}'";
        $resulted =$this->dbcon->query($sql);
        $output = "";
        if($resulted->num_rows == 0){
            $output .= "<h1 style='color:green;'>You have no friends yet</h1>";
        } 
        elseif($resulted->num_rows > 0){
            $datas = array();
            while($datas = $resulted->fetch_assoc()){
              $sql3 = "SELECT * FROM user WHERE unique_id = '{$datas['friend_id']}'";
              $result = $this->dbcon->query($sql3);
           if($result->num_rows == 0){
              $output .="No users are available to chat";
           }elseif($result->num_rows > 0){
            while($data = $result->fetch_assoc()){
                $outgoing_id = $_SESSION['unique_id'];
                $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$data['unique_id']} OR outgoing_msg_id = {$data['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
                $results = $this->dbcon->query($sql2);
                $row = $results->fetch_assoc();
                if($results->num_rows > 0){
                    $results = $row['msg'];
                }else{
                    $results = "No message available";
                }
                (strlen($results) > 28) ? $msg = substr($results,0,28).'....' : $msg = $results;
                ($data['status'] == "Offline now") ? $offline = "offline" : $offline = "";
                if(empty($data['photo'])){
                    $data['photo'] ="usericons.png";
                }
                $output .= '<a href="userchat.php?unique_id='.$data['unique_id'].'"><div class="friends">
                <img src="profile/'.$data['photo'].'" alt="">
                    <div class="details">
                        <span>'.$data['username'].'</span>
                        <p>'.$msg.'</p>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>     
                    </div>
                </div></a>';
            }
           }
        }
    }
           echo $output;
    }

    function select_friend($emails_id,$searchTerm){
        $sql = "SELECT * FROM user WHERE NOT email = '{$emails_id}' AND username LIKE '%{$searchTerm}%'";
        $result = $this->dbcon->query($sql);
          $output = "";
          if($result->num_rows > 0){
            while($data = $result->fetch_assoc()){
                ($data['status'] == "Offline now") ? $offline = "offline" : $offline = "";
                if(empty($data['photo'])){
                    $data['photo'] ="usericons.png";
                }
                $output .= '<div class="friends">
                <img src="profile/'.$data['photo'].'" alt="">
                    <div class="details">
                        <span>'.$data['username'].'</span>
                        <p></p>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                    </div>
                </div>';
            }
          }else{
            $output .= "<h2 style='margin-top:50px;'>No user found related to your search term</h2>";
          }
          echo $output;
    }

    function select_user($email){
        $sql = "SELECT * FROM user WHERE unique_id = '{$email}'";
        $result =$this->dbcon->query($sql);
         $row = $result->fetch_assoc();
           if($result->num_rows == 1){
             return $row;
           }else{
               return $row;
           }
    }

    function insert_message($outgoing_id,$incoming_id,$message){
        if(!empty($message)){
        $sql = "INSERT INTO messages(incoming_msg_id,outgoing_msg_id,msg) VALUES('{$incoming_id}','{$outgoing_id}','{$message}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
        //    echo "Inserted successfully";
        }else{
            // echo "error";
        }
        }else{
          header("Location:userchat.php");
        }
    }

    function get_messages($outgoing_id,$incoming_id){
        $outpot = "";
        $sql = "SELECT * FROM messages LEFT JOIN user ON user.unique_id = messages.outgoing_msg_id WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $result = $this->dbcon->query($sql);
        if($result->num_rows > 0){
           while ($info = $result->fetch_assoc()) {
               if($info["outgoing_msg_id"] === $outgoing_id){
                   $outpot .= '<div class="my-chat">'.$info["msg"].'</div>';
               }else{
                if(empty($info['photo'])){
                    $info['photo'] ="usericons.png";
                }
                   $outpot .=' <div style="display:flex;"><img src="profile/'.$info['photo'].'" alt="" style="border-radius:50%; width:4rem; height:4rem;">
                   <div class="client-chat">'.$info["msg"].'</div></div>';
               }   
           }
           echo $outpot;
        }else{
         echo $this->dbcon->error;
        }
    }

    function update_status($idd){
        $status = "Offline now";
        $sql = "UPDATE user SET status = '{$status}' WHERE unique_id = {$idd}";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
           session_destroy();
            header("Location: index.php?msg=Successfully logged out");
            exit;
        }else{
            echo $this->dbcon->error;
        }
    }

    function update_stats($idd){
        $status = "Active now";
        $sql = "UPDATE user SET status = '{$status}' WHERE unique_id = {$idd}";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            echo "Nice";
        }else{
            echo $this->dbcon->error;
        }
    }

    function update_info($newinfo,$email){
        $sql = "UPDATE user SET bio='{$newinfo}' WHERE email='{$email}'";
        $result = $this->dbcon->query($sql);
     
             //check if the connection runs successfully
             if($this->dbcon->affected_rows==1){
               //   echo "<h3 align='center'>Photo added successfully</h3>";
             }else{
               //   echo  //$this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
             }
    }

    function insert_friend($user_id,$username,$friend_id){
        $sql4 = "INSERT INTO friends(user_id,friend_id,friend_username) VALUES('{$user_id}','{$friend_id}','{$username}')";
        $result = $this->dbcon->query($sql4);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
          }else{
            //   echo  //$this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }


    }

?>