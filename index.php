<?php
    require 'src/utils/jwt.php';

    session_start();
    json_encode('test');
    exit;

    if(isset($_SESSION['ID'])) {
        if(!isset($_COOKIE['auth_token'])) {
            session_destroy();
            header('Location: /');
        }
    }
    require 'src/config/dbInit.php';
    require 'src/routes/index.php';
?>