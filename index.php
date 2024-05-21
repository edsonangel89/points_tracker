<?php
    session_start();

    if(isset($_SESSION['ID'])) {
        if(!isset($_COOKIE['Authorization']) && !isset($_COOKIE['User'])) {
            session_destroy();
            header('Location: /');
        }
        else {
            if(isset($_COOKIE['Authorization'])) {
                setcookie('Authorization', $_COOKIE['Authorization'], time() + 60,"/",false, true);
            }
            elseif(isset($_COOKIE['User'])) {
                setcookie('User', $_SESSION['ID'], time() + 60,"/",false, true);
            }
        }
    }
    
    require 'src/config/dbInit.php';
    require 'src/routes/index.php';
?>