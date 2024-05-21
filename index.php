<?php
    session_start();

    if(isset($_SESSION['ID'])) {
        if(!isset($_COOKIE['Authorization']) && !isset($_COOKIE['User'])) {
            session_destroy();
        }
    }
    
    require 'src/config/dbInit.php';
    require 'src/routes/index.php';
?>