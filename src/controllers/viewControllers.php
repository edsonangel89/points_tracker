<?php

    //require 'src/utils/jwt.php';

    function get_home($current_role) {
        $roles = [
            'admin' => 'src/views/admin.php',
            'user' => 'src/views/profile.php',
            'nouser' => 'src/views/home.php'
        ];  
        require $roles[$current_role];
    }

    function get_login($current_role) {
        switch($current_role) {
            case 'superadmin':
                header('Location: /');
            break;
            case 'admin':
                header('Location: /');
            break;
            case 'user':
                header('Location: /');
            break;
            default:
                require 'src/views/login.php';
            break;
        }
    }

    function get_sign($current_role) {
        switch($current_role) {
            case 'superadmin':
                header('Location: /');
            break;
            case 'admin':
                header('Location: /');
            break;
            case 'user':
                header('Location: /');
            break;
            default:
                require 'src/views/sign.php';
            break;
        }
    }

    function get_confirm() {
        require 'src/utils/jwt.php';
        require 'src/controllers/userControllers.php';
        $user = get_user_by_email($_GET['email']);
        //echo json_encode($user);
        //exit;
        $email_verified = $user['EmailVerified'];
        if(isset($_GET['token']) && !$email_verified) {
            $token = $_GET['token']; 
            if(verify_jwt($token)) {
                require 'src/views/confirmMail.php';
            }
            else {
                http_response_code(404);
                echo json_encode('token-failed');
            }
        }
        else {
            require 'src/views/404.php';
        }
        
    }

    function get_succeed() {
        require 'src/utils/jwt.php';
        require 'src/controllers/userControllers.php';
        if(isset($_GET['email'])) {
            $email = $_GET['email'];
            $user = get_user_by_email($email);
            $email_verified = $user['EmailVerified'];
            if(isset($_GET['token']) && $email_verified) {
                if(verify_jwt($_GET['token'])) {
                    require 'src/views/succeed.php';
                }
                else {
                    require 'src/views/404.php';
                }
            }
            else {
                require 'src/views/404.php';
            }
        }
        else {
            require 'src/views/404.php';
        }
        
    }

    function confirm() {
        require 'src/controllers/userControllers.php';
        //require 'src/utils/jwt.php';
        //require 'src/models/userModels.php';
        if(isset($_GET['email']) && isset($_GET['token'])) {
            $email = $_GET['email'];
            $token = $_GET['token'];
           /* $match = verify_jwt($token);
            //$is_email_verify = User::update_email_verify($email);
            if($match && $is_email_verify) {
                http_response_code(200);
                header("Location: /succeed?email=$email&token=$token");
            }
            else {
                http_response_code(400);
                echo json_encode('email-no-verified');
            }*/
            //echo json_encode($email);
            //echo json_encode($token);
            //exit;
            confirm_email($email, $token);
            exit;

        }
        else {
            require 'src/views/404.php';
        }
    }

    function get_info($current_role) {
        if($current_role == 'admin') {
            require 'src/views/info.php';
        }
        else {
            header('Location: /checker/');
        }
    }

    function not_found_page() {
        require 'src/views/404.php';
    }

?>