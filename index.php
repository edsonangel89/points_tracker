<?php
    require 'src/utils/jwt.php';

    ini_set('session.use_cookies', 0);
    ini_set('session.use_only_cookies', 0);
    ini_set('session.use_trans_sid', 1);

    session_start();

    if(isset($_SESSION['ID'])) {
        if(!isset($_COOKIE['auth_token'])) {
            session_destroy();
            header('Location: /');
        }
        else {
            $user_token = $_COOKIE['auth_token'];
            $user_role = get_jwt_info($user_token);
            if($user_role == 'admin' || $user_role == 'superadmin') {
                header("Authorization: Bearer $user_token");
                /*setcookie('auth_token', "$user_token", time() + (3600 * 12),"/","",true, true);
                /*echo "admin";
            exit;*/
            }
            elseif ($user_role == 'user') {
                header("Authorization: Bearer $user_token");
                setcookie('auth_token', "$user_token", time() + (86400 * 7),"/","",true, true);
                /*echo "user";
                exit;*/
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
        require 'src/config/dbInit.php';
        require 'src/routes/index.php';
    }
?>