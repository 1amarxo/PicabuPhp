<?php 
    require_once 'db.php';
    
    if(isset($_POST['login_user'])){
        if (isset($_POST['username'])) { $username = $_POST['username']; }
        if (isset($_POST['password'])) { $password = $_POST['password']; }
      
        if(empty($username))
        {
            array_push($errors,"Enter username");
        }
        if(empty($password))
        {
            array_push($errors,"Enter password");
        }
        if(count($errors)==0){
            $password=md5($password);

            $query = "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)){
                
                $_SESSION['username'] = $username;
                
                $_SESSION['success'] = "SUUSCRSS";
                header("location: index.php");
            }
            else{
                array_push($errors,"Wrong username or password");
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/login-style/style.css">
    <link rel="stylesheet" href="./style/style.css">
    <title>Registration</title>

</head>
<body>
    <div class="singin-container">
  
        <h1>Log In</h1>
        
        <hr>
        <form method="POST" name="reg" action="login.php">
            <div class="container">
              
            
                <input 
                    placeholder="Username"
                    type="text"
                    id="username"
                    minlength="7"
                    maxlength="20"
                    name="username"
                    class="input" required>
                <input 
                     placeholder="Password"
                     type="password"
                     id="password"
                     minlength="7"
                     maxlength="36"
                     name="password"
                     class="input" required>

                </div>

              
        
                
                <button name="login_user" type="submit" class="registerbtn">Log In</button>
              
              <div class="container signin">
                <p>Want to create a user? <a href="register.php">Sign up</a>.</p>
              </div>
        </form>
        
    </div>
</body>
</html>