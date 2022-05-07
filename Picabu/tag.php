<?php

   $tag=isset($_GET['tag']) ? $_GET['tag'] :'' ;
 
?>


<div class="container">
    <div class="sub-container">

        <div class="main-content">
            <div class="post">
               
            <?php

                $sql = "SELECT `post`.`id`,`post`.`userid`,`post`.`image`,`post`.`title`,`post`.`content`
                FROM `post_category` 
                JOIN `post` ON `post_category`.`postid`=`post`.`id` 
                JOIN `category` ON `post_category`.`categoryid`=`category`.`id` WHERE `category`.`name`='$tag' ";
                $result = mysqli_query($conn, $sql);
                ?>
                
                
                <?php while($row = mysqli_fetch_assoc($result)):

                    $postid=$row['id'];
                    $userid=$row['userid'];
                        
                    $sql_user = "SELECT `user`.`username`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `id`='$userid'";
                    $result_user = mysqli_query($conn, $sql_user);
                    $username=mysqli_fetch_assoc($result_user);

                    
                    $sql_categoryid = "SELECT `category`.`name` FROM `post_category` 
                    JOIN `post` ON `post_category`.`postid`=`post`.`id` 
                    JOIN `category` ON `post_category`.`categoryid`=`category`.`id` WHERE `post`.`id` IN(
                        
                    SELECT `post`.`id`
                    FROM `post_category` 
                    JOIN `post` ON `post_category`.`postid`=`post`.`id` 
                    JOIN `category` ON `post_category`.`categoryid`=`category`.`id` WHERE `category`.`name`='$tag' AND `post`.`id`= '$postid') ";

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