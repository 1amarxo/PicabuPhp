<?php

    if( isset( $_GET['action'] ) && $_GET['action'] == "add") {

        $_SESSION['username'] = $username;
        header("Location: add.php");
    }


    $sql = "SELECT * FROM `post`";
    $result = mysqli_query($conn, $sql);          
?>
<h1>Actual Posts</h1>
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
                        JOIN `category` ON `post_category`.`categoryid`=`category`.`id` WHERE `postid`='$postid'";

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