<?php


    $dbhost = "localhost";
    $dbuser = "root";
    $dbname = "picabu";

    $username="";
    $email="";

    
    $errors= array();

    //connection
    $conn= mysqli_connect($dbhost,$dbuser,'',$dbname);
    
    if (!$conn){die('No connection with DB');}




    
?>