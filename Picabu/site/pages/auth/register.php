<?php
    require_once('db.php');
    
    if(isset($_POST['reg_user'])){

        if (isset($_POST['username'])) { 
            if(empty($_POST['username'])){
                array_push($errors,"Username is required");
            }
            else $username = $_POST['username'];
            
        }
        if (isset($_POST['email'])) { $email = $_POST['email']; }
        if (isset($_POST['pass1'])) { $pass1 = $_POST['pass1']; }
        if (isset($_POST['pass2'])) { $pass2 = $_POST['pass2']; }
        

        //form validation
        
        
        if(empty($email)){array_push($errors,"Email is required");}
        
        if(empty($pass1)){array_push($errors,"Password is required");}

        if($pass1 != $pass2) {array_push($errors,"Passwords don't match");}


        //check db for existing user 

        $user_check_query= "SELECT * FROM `user` WHERE `username`='$username' or `email`='$email' LIMIT 1";
        $results = mysqli_query($conn,$user_check_query);
        $user = mysqli_fetch_assoc($results);

        if($user){
            if($user['username']===$username){array_push($errors,"Username already exists");}
            if($user['email']===$email){array_push($errors,"Email already exists");}
        }

        //Register user if no error

        if(count($errors) == 0){
            $password= md5($pass1);
            $query="INSERT INTO `user` (`username`,`email`,`password`,`userimg`) VALUES ('$username','$email','$password','picabu.png')";
           
            mysqli_query($conn,$query);
            
            $_SESSION['userid'] = mysqli_insert_id($conn);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logger in";
            header("location: ../site");
            
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
    <link rel="stylesheet" href="">
    <title>Registration</title>

</head>
<body>
    <div class="singin-container">
  
        <h1>Create an account</h1>
        <p>Create and start managing your candidate!</p>
        
        <form method="POST" name="reg" >

            <div class="container">
              
            
                <input
                    placeholder="Email"
                    type="email"
                    name="email"
                    class="input" required>
            
                <input
                    placeholder="User Name"
                    type="text"
                    minlength="7"
                    maxlength="15"
                    name="username"
                    class="input" required>
                <input 
                     placeholder="Password"
                     type="password"
                     minlength="7"
                     maxlength="36"
                     name="pass1"
                     class="input" required>

                     <input 
                     placeholder="Confirm Password"
                     type="password"
                     minlength="7"
                     maxlength="36"
                     name="pass2"
                     class="input" required>
                    </div>

              
        
                   
                <button name="reg_user" type="submit" class="registerbtn">Register</button>
              
            <?php include('pages/layout/errors.php')?>
              <div class="container signin">
                 <p>Already have a user? <a href="?page=login">Log in</a>.</p>
              </div>
        </form>
        
    </div>
</body>
</html>