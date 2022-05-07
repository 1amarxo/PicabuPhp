<?php
  require_once('db.php');
  $username=isset($_GET['user']) ? $_GET['user'] :'' ;
 if(!isset($_SESSION['username'])){
    
    header('Location: ?page=login');
  }
 
  function GUID()
    {
        if (function_exists('com_create_guid') === true) return trim(com_create_guid(), '{}');
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
  if(isset($_POST["submit"])){


     
      $dir = "img/";
      $file=$_FILES["photo"];
      $path = $dir . $_FILES["photo"]["name"];
      $ok = true;
      $ext= strtolower(pathinfo($path,PATHINFO_EXTENSION));
      $check = getimagesize( $file["tmp_name"] );
      $ok = ($check == false || file_exists($path) || $file["size"] > 500000 ||
      $ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) ? 0 : 1;
      if ($ok) {
        $fileName = md5(GUID()) .'.'. $ext;
      
        $path = $dir . $fileName;
        move_uploaded_file($file["tmp_name"], $path);
        
        $sql_insert_post = "UPDATE `user` SET `userimg`='$fileName' WHERE `id` = '".$_SESSION['userid']."'";
        mysqli_query($conn, $sql_insert_post);}
        
    }
?>

<?php

    $sql = "SELECT * FROM `post` WHERE `userid`='".$_SESSION['userid']."'";
    $result = mysqli_query($conn, $sql);

    $sql_user = "SELECT `user`.`username`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `id`='".$_SESSION['userid']."'";
    $result_user = mysqli_query($conn, $sql_user);
    while($row_user = mysqli_fetch_assoc($result_user)){
        $userimg=$row_user['userimg'];
        $username=$row_user['username'];
    }
    ?>
<div class="about">
<form method="POST" name="add"   enctype="multipart/form-data">
    <h1>My Posts</h1>
    <div class="profile">
        <label class="custom-file-upload"><img class="custom-file-upload" src="img/<?=$userimg?>"></img><input required name="photo" type="file" accept="image/*" /></label>
        
        <h1 class="username"><?=$username?></h1>
    </div>

    <p><input class="upload-btn" name="submit" type="submit" value="Save"/></p>
    </form>
</div>
    <div class="container">
        <div class="sub-container">
            <div class="main-content">
                <div class="post">
                
                <?php while($row = mysqli_fetch_assoc($result) ):



                    $postid=$row['id'];
                    $userid=$row['userid'];
                        
                    $sql_user = "SELECT `user`.`username`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `id`='$userid'";
                    $result_user = mysqli_query($conn, $sql_user);
                    $username=mysqli_fetch_assoc($result_user);
                    
                    
                    $sql_categoryid = "SELECT `category`.`name` FROM `post_category` 
                    JOIN `post` ON `post_category`.`postid`=`post`.`id` 
                    JOIN `category` ON `post_category`.`categoryid`=`category`.`id` WHERE `post`.`id`='$postid'";

                    $result_categoryid = mysqli_query($conn, $sql_categoryid);
                    ?>
                    
                    
                    
                    <?php include('card.php')?>
                    
                <?php endwhile?>

                    
                    
                    
              
                
            </div>
        </div>
        <aside class="right-aside">
            <div class="add-post">
                <a class="add" href="?page=add">Add Post</a>
            </div>
        </aside>
    
    </div>
</div>
 
</div>
</body>
</html>