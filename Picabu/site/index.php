
<?php    
    
    if( isset($_SESSION['username'])) 
    header("Location: login.php");{
    }
    if( isset( $_GET['action'] ) && $_GET['action'] == "logout") {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
    
    require_once "db.php";
    include "header.php";
    include "main.php";

?>