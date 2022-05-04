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


                $sql_user = "SELECT `user`.`username`,`user`.`email` FROM `user` WHERE `id`='".$_SESSION['userid']."'";
                $result_user = mysqli_query($conn, $sql_user);
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
                    
                    
                    <div class="item-1">
                        <div href="" class="card">
                            <article>
                            <div class="user_profile">
                                    <img  src="img/<?=$username['userimg']?>">
                                    <div class="name">
                                        <a href="?page=userposts&user=<?=$username['username']?>"><?=$username['username']?></a>
                                    </div>
                                </div>
                               
                                <h1><?=$row['title']?></h1>
                                <span><?=$row['content']?></span>
                                
                            </article>
                            <div class="thumb" style="background-image: url(img/<?=$row['image']?>);"></div>
                            <article>
                                <div class="tags">
                                    <?php while($row_tag = mysqli_fetch_assoc($result_categoryid)):?>
                                        <a href="?page=tag&tag=<?=$row_tag['name']?>"><?=$row_tag['name']. "&nbsp;"?></a>
                                    <?php endwhile?>
                                </div>
                            </article>
                        </div>
                    </div>
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