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
            $user_role = get_jwt_info($user_token);
            if($user_role == 'admin' || $user_role == 'superadmin') {
                echo $user_role;
            exit;
                setcookie('auth_token', "$user_token", time() + (3600 + 12),"/","",true, true);
            }
            elseif ($user_role == 'user') {
                setcookie('auth_token', "$user_token", time() + (86400 * 7),"/","",true, true);
                echo $user_role;
            exit;
            }

            /*
            echo $user_role;
            exit;
            */
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