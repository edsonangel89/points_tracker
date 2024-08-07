<?php

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
        include 'src/utils/jwt.php';
        require 'src/controllers/userControllers.php';
        $user = get_user_by_email($_GET['email']);
        /*echo json_encode($user);
        exit;*/
        $email_verified = $user['EmailVerified'];
        if(!$email_verified) {
            $token_gen = urldecode(generate_jwt(htmlspecialchars($_GET['email'])));  
            if($token_gen) {
                require 'src/views/confirmMail.php';
            }
            else {
                http_response_code(404);
                echo json_encode('token-failed');
            }
        }
        else {
            http_response_code(404);
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
                $token = urldecode($_GET['token']);
                $match = verify_jwt($token); 
                if($match) {
                    require 'src/views/succeed.php';
                }
                else {
                    echo json_encode("verify-failed");
                }
            }
            else {
                echo json_encode("no-token-no-email");
            }
        }
        else {
            echo json_encode("no-email-set");
        }
        
    }

    function get_info($current_role) {
        if($current_role == 'admin') {
            require 'src/views/info.php';
        }
        else {
            header('Location: /');
        }
    }

    function get_jwt_verify() {
        require 'src/utils/jwt.php';
        if(isset($_GET['email'])) {
            $email = $_GET['email'];
            $jwt = generate_jwt($email);
            $jwt_urlencoded = urlencode($jwt);
            $jwt_base64 = base64_encode($jwt);
            echo "JWT => " . $jwt  . "<br>";
            echo "JWT_URLDECODE => " . $jwt_urlencoded  . "<br>";
            echo "JWT_64ENCODE => " . $jwt_base64  . "<br>";
            exit;
        }
        else {
            echo 'Error verification';
        }
    }

    function not_found_page() {
        require 'src/views/404.php';
    }

?>