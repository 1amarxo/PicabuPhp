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
    if(isset($_POST["submit-name"])){


        if(isset($_POST['username'])) { $username = $_POST['username']; }
    
        if(isset($_POST['email'])) { $useremail = $_POST['email']; }
        
        $sql_insert_post = "UPDATE `user` SET  `email`='$useremail', `username`='$username' WHERE `id` = '".$_SESSION['userid']."'";
        mysqli_query($conn, $sql_insert_post);
        $_SESSION['username']=$username;
    }


        if(isset($_POST['submit'])){
    
            $dir = "resources/img/";
            $file=$_FILES["photo"];
            $path = $dir . $_FILES["photo"]["name"];
            $ok = true;
            $ext= strtolower(pathinfo($path,PATHINFO_EXTENSION));
            $check = getimagesize( $file["tmp_name"] );
            $ok = ($check == false || file_exists($path) || $file["size"] > 10000000 ||
            $ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) ? 0 : 1;
    
    
            if ($ok) {
                $fileName = md5(GUID()) .'.'. $ext;
        
                $path = $dir . $fileName;
                move_uploaded_file($file["tmp_name"], $path);        
                $sql_insert_post = "UPDATE `user` SET `userimg`='$fileName' WHERE `id` = '".$_SESSION['userid']."'";
                mysqli_query($conn, $sql_insert_post);
            }
        }


        
?>



<?php

$username_Session=isset($_GET['user']) ? $_GET['user'] :'' ;

$sql_user = "SELECT `user`.`username`,`user`.`id`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `username`='$username_Session'";
$result_user = mysqli_query($conn, $sql_user);
$user=mysqli_fetch_assoc($result_user);


$sql = "SELECT * FROM `post` WHERE `userid`='".$_SESSION['userid']."'";
$result = mysqli_query($conn, $sql);


    $sql = "SELECT * FROM `post` WHERE `userid`='".$_SESSION['userid']."'";
    $result = mysqli_query($conn, $sql);

    $sql_user = "SELECT `user`.`username`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `id`='".$_SESSION['userid']."'";
    $result_user = mysqli_query($conn, $sql_user);
    while($row_user = mysqli_fetch_assoc($result_user)){
        $userimg=$row_user['userimg'];
        $username=$row_user['username'];
        $useremail=$row_user['email'];
        
    }
?>


<div class="about-settings">
    <div class="settings">
        <label class="custom-file-upload-user"><img class="custom-file-upload-user" src="resources/img/<?=$userimg?>"></img></label>
        
        <h1 class="username"><?=$username?></h1>
    </div>
    <h1 >Public profile</h1>
    <hr style="width: 100%; opacity:0.6;">
    

    <div class="profile-input-settings">

        <form method="POST" name="settings" enctype="multipart/form-data">
            
            <div class="container">
                <div class="container-settings-inputs">
                    <span>Name</span>
                    <input 
                            placeholder="Username"
                            type="text"
                            id="username"
                            minlength="4"
                            maxlength="15"
                            name="username"
                            value="<?=$username?>"
                            class="input-settings" required>
                    <span>Email</span>
                    <input 
                        placeholder="Email"
                        type="email"
                        id="email"
                        minlength="7"
                        maxlength="36"
                        name="email"
                        value="<?=$useremail?>"
                        class="input-settings" required>
                        <p><input class="upload-btn" for="settings" name="submit-name" type="submit" value="Submit"/></p>
 
                </div>
                
            
        </form>
                <div class="container-settings-image">
                                        
                    <form method="POST"  enctype="multipart/form-data">
                        <span>Profile Image</span>
                        <label class="custom-file-upload"><img class="custom-file-upload" src="resources/img/<?=$userimg?>"></img><input required name="photo" type="file" accept="image/*" /></label>
                        <p><input class="upload-btn" name="submit" type="submit" value="Save"/></p>
                    </form>
                </div>

            </div>
                
                <?php include('pages/layout/errors.php')?>
        
            </div>
    </div>
</div>