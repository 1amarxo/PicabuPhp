<?php

        $postid=isset($_GET['id']) ? $_GET['id'] :'' ;


        $sql = "SELECT * FROM `post` WHERE `post`.`id`='$postid'";
        $result = mysqli_query($conn, $sql);
        
        
        if(isset($_POST['content'])) { $content = $_POST['content']; }

        if(isset($_POST["submit"]) ){
            if(!isset($_SESSION['username'])){
                header('location: ?page=login');
            }
          $sql_insert_comment = "INSERT INTO `comment` (`userid`,`postid`,`content`) VALUES ('".$_SESSION['userid']."', '$postid', '$content')";
          mysqli_query($conn, $sql_insert_comment);
         
        }
        
?>




<?php while($row = mysqli_fetch_assoc($result)):

$postid=$row['id'];
$userid=$row['userid'];
    
$sql_user = "SELECT `user`.`username`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `id`='$userid'";
$result_user = mysqli_query($conn, $sql_user);
$username=mysqli_fetch_assoc($result_user);

$sql_categoryid = "SELECT `category`.`name` FROM `post_category` 
                        JOIN `post` ON `post_category`.`postid`=`post`.`id` 
                        JOIN `category` ON `post_category`.`categoryid`=`category`.`id` WHERE `postid`='$postid'";
$result_categoryid = mysqli_query($conn, $sql_categoryid); ?>
    

<div class="container">
    <div class="sub-container">

        <div class="main-content">
            <div class="post">
                <?php include('pages/layout/card.php')?>
            </div>
            <form method="POST" name="add" enctype="multipart/form-data">
                <div class="text-container">
            
                    <textarea 
                    placeholder="Enter text"
                    type="text"
                    id="content"
                    minlength="0"
                    name="content"
                    class="input" required></textarea>
            
                    <p><input class="upload-btn" name="submit" type="submit" value="Submit"/></p>
                </div>
            
            </form>
            <div class="commentaries">
                <?php 
                $sql_comment = "SELECT * FROM `comment` WHERE `comment`.`postid`='$postid'";
                $result_comment = mysqli_query($conn, $sql_comment); 

                
               
                while($comment_row = mysqli_fetch_assoc($result_comment)):
                    $sql_user_comment = "SELECT * FROM `user` WHERE `user`.`id`='".$comment_row['userid']."'";
                    $result_user_comment = mysqli_query($conn, $sql_user_comment);
                    $username_comment=mysqli_fetch_assoc($result_user_comment);?>
                <div class="comment">
                   <?php
                        if($username_comment['username'] != isset($_SESSION['username'])):?>
                            <a href="?page=userposts&user=<?=$username['username']?>"><?=$username_comment['username']?></a>
                        <?php else:?> 
                            <a href="?page=account&user=<?=$username_comment['username']?>"><?=$username_comment['username']?></a>
                    <?php endif?>
                    
                    <p><?=$comment_row['content']?></p>
                </div>
              
                <?php endwhile?>
            </div>
        </div>
    </div>
</div>

<?php endwhile?>