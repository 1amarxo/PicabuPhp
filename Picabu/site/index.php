
<?php    
    session_start();
        
    $page = isset($_GET['page']) ? $_GET['page'] : 'main';

    switch($page)
    {
        case "login": $page='auth/'.$page;break;
        case "register": $page='auth/'.$page;break;
        case "account": $page='user/'.$page;break;
        case "userposts": $page='user/'.$page;break;
        case "add": $page='add/'.$page;break;
        case "story": $page='story/'.$page;break;
        case "tag": $page='tag/'.$page;break;
        case "add": $page='add/'.$page;break;
        case "settings": $page='user/'.$page;break;
        case "main":;break;
        default: $page='layout/404';break;
    }
    
    require_once "db.php";

    include "pages/layout/header.php";
    include 'pages/'.$page.'.php';

?>