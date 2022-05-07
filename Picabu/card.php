<?php


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
        <div class="card-footer">
            <a href="?page=story&id=<?=$row['id']?>" class="card-comments">
                <span class="comment-icon"><i class="gg-comment"></i></span>
           
            </a>
        </div>
    </div>
</div>