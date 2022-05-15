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
        <label class="custom-file-upload-user"><img class="custom-file-upload-user" src="resources/img/<?=$userimg?>"></img></label>
        
        <h1 class="username"><?=$username?></h1>
        <a href="?page=settings&user=<?=$username?>" class="options-i"><i class="gg-options"></i></a>
    </div>

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
                    
                    
                    
                    <?php include('pages/layout/card.php')?>
                    
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