<?php

    if( isset( $_GET['action'] ) && $_GET['action'] == "logout") {
        session_unset();
        session_destroy();
        header("Location: ?page=login");
    }
    if( isset( $_GET['action'] ) && $_GET['action'] == "logIn") {
        header("Location: ?page=login");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/style/header-style/header-style.css">
    <link rel="stylesheet" href="resources/style/style.css">
    <link rel="stylesheet" href="resources/style/login-style/style.css">
    <link rel="stylesheet" href="resources/style/main-style/main.css">
    <link rel="stylesheet" href="resources/style/account-style/account.css">
    <link rel="stylesheet" href="resources/style/add-style/add-style.css">
    <link rel="stylesheet" href="resources/style/comment-style/comment.css">
    <title>Document</title>
    
</head>
<body>
    <div class="app">
        <header>
            <div class="main-header">
                
                <div class="header_logo">
                    <a href="?page=main">
                    <svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="none" d="M10,2.531c-4.125,0-7.469,3.344-7.469,7.469c0,4.125,3.344,7.469,7.469,7.469c4.125,0,7.469-3.344,7.469-7.469C17.469,5.875,14.125,2.531,10,2.531 M10,3.776c1.48,0,2.84,0.519,3.908,1.384c-1.009,0.811-2.111,1.512-3.298,2.066C9.914,6.072,9.077,5.017,8.14,4.059C8.728,3.876,9.352,3.776,10,3.776 M6.903,4.606c0.962,0.93,1.82,1.969,2.53,3.112C7.707,8.364,5.849,8.734,3.902,8.75C4.264,6.976,5.382,5.481,6.903,4.606 M3.776,10c2.219,0,4.338-0.418,6.29-1.175c0.209,0.404,0.405,0.813,0.579,1.236c-2.147,0.805-3.953,2.294-5.177,4.195C4.421,13.143,3.776,11.648,3.776,10 M10,16.224c-1.337,0-2.572-0.426-3.586-1.143c1.079-1.748,2.709-3.119,4.659-3.853c0.483,1.488,0.755,3.071,0.784,4.714C11.271,16.125,10.646,16.224,10,16.224 M13.075,15.407c-0.072-1.577-0.342-3.103-0.806-4.542c0.673-0.154,1.369-0.243,2.087-0.243c0.621,0,1.22,0.085,1.807,0.203C15.902,12.791,14.728,14.465,13.075,15.407 M14.356,9.378c-0.868,0-1.708,0.116-2.515,0.313c-0.188-0.464-0.396-0.917-0.621-1.359c1.294-0.612,2.492-1.387,3.587-2.284c0.798,0.97,1.302,2.187,1.395,3.517C15.602,9.455,14.99,9.378,14.356,9.378"></path>
                    </svg></a>
                </div>
                <ul class="menu">
                    <li><a id="navbar-button" href="?page=main">Actual</a></li>
                   
                    <li><a id="navbar-button" href="?page=account">My Posts</a></li>
                </ul>
                <div class="header_right-menu">

                    <?php if(isset($_SESSION['username'])) :?>
                        <p><?=$_SESSION['username']?></p>
                        <a class="logout" href="?action=logout"><span>Log out</span></a>
                    <?php else : ?>
                        <a class="login" href="?action=logIn"> LogIn</a>
                    <?php endif?>
                </div>

            </div>
        </header>
    
