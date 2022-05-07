<?php


    $dbhost = "localhost";
    $dbuser = "root";
    $dbname = "picabu";

    $username="";
    $email="";

    
    $errors= array();

    //connection
    $conn= mysqli_connect($dbhost,$dbuser,'123321',$dbname);
    
    if (!$conn){die('No connection with DB');}




    
?>