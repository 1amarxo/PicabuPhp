<?php

$username=isset($_GET['user']) ? $_GET['user'] :'' ;

$sql_user = "SELECT `user`.`username`,`user`.`id`,`user`.`email`,`user`.`userimg` FROM `user` WHERE `username`='$username'";
$result_user = mysqli_query($conn, $sql_user);
$user=mysqli_fetch_assoc($result_user);


$sql = "SELECT * FROM `post` WHERE `userid`='".$user['id']."'";
$result = mysqli_query($conn, $sql);

?>


<div class="about">
<form method="POST" name="add"  action="account.php" enctype="multipart/form-data">
    <h1>Posts</h1>
    <div class="profile">
        <label class="custom-file-upload"><img class="custom-file-upload" src="img/<?=$user['userimg']?>"></img><input required name="photo" type="file" accept="image/*" /></label>
        
        <h1 class="username"><?=$user['username']?></h1>
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
                    
                    
                    <div class="item-1">
                        <div href="" class="card">
                            <article>
                                <div class="user_profile">
                                    <img  src="img/<?=$user['userimg']?>">
                                    <div class="name">
                                        <a href="?page=userposts&user=<?=$user['username']?>"><?=$user['username']?></a>
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