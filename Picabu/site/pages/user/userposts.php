<?php

$username_Session=isset($_GET['user']) ? $_GET['user'] :'' ;

$sql_user = "SELECT `user`.`username`,`user`.`id`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `username`='$username_Session'";
$result_user = mysqli_query($conn, $sql_user);
$username=mysqli_fetch_assoc($result_user);


$sql = "SELECT * FROM `post` WHERE `userid`='".$username['id']."'";
$result = mysqli_query($conn, $sql);

?>


<div class="about">
<form method="POST" name="add"  action="account.php" enctype="multipart/form-data">
    <h1>Posts</h1>
    <div class="profile">
        <label class="custom-file-upload-user"><img class="custom-file-upload-user" src="resources/img/<?=$username['userimg']?>"></img></label>
        
        <h1 class="username"><?=$username['username']?></h1>
    </div>

   
    </form>
</div>
<div class="container">
    <div class="sub-container">
        <div class="main-content">
            <div class="post">
                
                <?php while($row = mysqli_fetch_assoc($result) ):



                    $postid=$row['id'];
                    
                    
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