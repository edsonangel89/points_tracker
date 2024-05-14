<?php

    require 'src/controllers/sessionControllers.php';
    require 'src/utils/inputValidation.php';

    $session_routes = [
        '/login' => 'login',
        '/logout' => 'logout',
        '/user' => 'user',
        '404'=> 'not_found_page'
    ];

    $sub_path = substr($path, 13);

    if(preg_match_all('/\/login/', $sub_path)) {
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $user_email = validate_email($_POST['email']);
            $user_password = validate_password($_POST['password']);
            $user = [
                $user_email,
                $user_password
            ];
            if($user_email && $user_password) {
                call_user_func_array($session_routes['/login'], $user);
            }
            else {
                call_user_func($session_routes['404']);
            }
        }
        else {
            http_response_code(404);
            echo json_encode('Non-user');
        }
    }
    elseif(preg_match_all('/\/logout/', $sub_path)) {
        if(isset($_GET['uid'])) {
            $user_id = $_GET['uid'];
            call_user_func($session_routes['/logout'], $user_id);
        }
        else {
            http_response_code(404);
            echo json_encode('Non-id');
        }
    }
    elseif(preg_match_all('/\/user/', $sub_path)) {
        if(isset($_SESSION['ID'])) {
            call_user_func($session_routes['/user'], $_SESSION['ID']);
        }
        else {
            http_response_code(404);
            echo json_encode('No-user-logged');
        }
    }
    

?>