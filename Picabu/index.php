
<?php    
    session_start();
        
    $page = isset($_GET['page']) ? $_GET['page'] : 'main';

    
    require_once "db.php";

    include "header.php";
    include $page.'.php';

?>