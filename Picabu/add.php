<?php   

  require_once('db.php');

  
  $tag_id=0;
  if(!isset($_SESSION['username'])){
    
    header('Location: ?page=login');
  }
  if(isset($_POST['title'])) { $title = $_POST['title']; }
  if(isset($_POST['content'])) { $content = $_POST['content']; }
  function GUID()
    {
        if (function_exists('com_create_guid') === true) return trim(com_create_guid(), '{}');
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
  if(isset($_POST["submit"])){

      session_start();
     
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
        echo $fileName;
        $path = $dir . $fileName;
        move_uploaded_file($file["tmp_name"], $path);
        
        $sql_insert_post = "INSERT INTO `post` (`title`,`userid`,`content`,`image`) VALUES ('$title', '".$_SESSION['userid']."', '$content', '$fileName')";
        mysqli_query($conn, $sql_insert_post);
    }

      // INSERT DATA TO 'POST' TABLE
      

      //SELECT ID for user
      $query="SELECT `id` FROM `post` WHERE `title`='$title' AND `content`='$content'";
      $result=mysqli_query($conn, $query);
      while($row=mysqli_fetch_row($result)) {
        $pid=$row[0];
      } 
      
      //GET tags array from POST
      $tags = explode("," , $_POST['category']);
      foreach($tags as $tag) {
          //SELECT CATEGORY
          $sql_select_category="SELECT * FROM `category` WHERE `name` = '".$tag."'";
          $res = mysqli_query($conn,$sql_select_category);
          
          
          //CHECK FOR EXISTING TAG
          if(mysqli_num_rows($res)==0) {
            //INSET TAG
            $sql_insert_category="INSERT INTO `category` (`name`) VALUES ('".$tag."')";
            mysqli_query($conn,$sql_insert_category);
            //GET NEW ID 
            $tag_id = mysqli_insert_id($conn);
        
            
          } else {
             //GET EXCISTING ID 
              $tag = mysqli_fetch_assoc($res);
              $tag_id = $tag['id'];
          }
          //INSERT TO MANY TO MANY
          $sql_insert_post_category="INSERT INTO `post_category`(`postid`,`categoryid`) VALUES ('.$pid.', '".$tag_id."')";
          mysqli_query($conn,$sql_insert_post_category);
      }


      header("location: ../site");
      
  }

       
?>

<div class="container">
  <div class="content">

    <form method="POST" name="add"  action="add.php" enctype="multipart/form-data">
      <div class="title-dv">
          <input 
              placeholder="Title or link to the post for answer"
              type="text"
              id="title"
              minlength= "3"
              maxlength="40"
              name="title"
              class="input" required>
      </div>
      <div class="upload-text">
          <div class="text-container">
              <textarea 
              placeholder="Enter text"
              type="text"
              id="content"
              minlength="0"
              name="content"
              class="input" required></textarea>
          </div>
          <div class="img-dv">
            <label class="custom-file-upload"><input required name="photo" type="file" accept="image/*" /><i class="gg-attachment"></i></label>
            
          </div>
         
        </div>

      <div class="category-dv">
        <textarea 
              placeholder="Enter tags using comma"
              type="text"
              id="content"
              minlength="0"
              name="category"
              class="input" required></textarea>
      </div>

      <p><input class="upload-btn" name="submit" type="submit" value="Upload"/></p>
    </form>   

  </div>
</div>

    
</body>
</html>

<script>
  const tx = document.getElementsByTagName("textarea");
  for (let i = 0; i < tx.length; i++) {
    tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;");
    tx[i].addEventListener("input", OnInput, false);
  }

  function OnInput() {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
  }
</script>