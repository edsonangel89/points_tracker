<?php
    session_start();

    if(isset($_SESSION['ID'])) {
        if(!isset($_COOKIE['auth_token'])) {
            session_destroy();
            header('Location: /');
        }
        else {
            include 'src/utils/jwt.php';
            $user_token = $_COOKIE['auth_token'];
            $is_token_correct = verify_jwt($user_token);
            echo json_encode($is_token_correct);

            /*if(isset($_COOKIE['auth_token'])) {
                setcookie('auth_token', $_COOKIE['auth_token'], time() + (3600 + 12),"/","",true, true);
            }
            elseif(isset($_COOKIE['User'])) {
                setcookie('User', $_SESSION['ID'], time() + (86400 * 7),"/",false, true);
            }*/
        }
    }
    
    require 'src/config/dbInit.php';
    require 'src/routes/index.php';

?>