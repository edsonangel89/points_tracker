<?php
    session_start();

    require 'src/utils/jwt.php';
    //generate_jwt('eascenciog65@gmail.com');
    verify_jwt(generate_jwt('eascenciog65@gmail.com'));
    
    /*if ($_SESSION['ROLE'] == 'user') {
        //call_user_func($views_routes[$path], 'user');
        session_destroy();
    }*/
    /*if(isset($_SESSION['ID'])) {
        if($_SESSION['ID'] == 1) {
            if(!isset($_COOKIE['Authorization'])) {
                session_destroy();
                header('Location: /');
            }
        }
    }*/

    require 'src/config/dbInit.php';
    require 'src/routes/index.php';
?>