<?php
    session_start();
    if(isset($_SESSION['ID'])) {
        if($_SESSION['ID'] == 1) {
            if(!isset($_COOKIE['Authorization'])) {
                session_destroy();
                header('Location: /checker/');
            }
        }
    }

    require 'src/config/dbInit.php';
    require 'src/routes/index.php';
?>