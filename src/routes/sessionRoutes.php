<?php

    require 'src/controllers/sessionControllers.php';

    $session_routes = [
        '/login' => 'login',
        '/logout' => 'logout',
        '404'=> 'not_found_page'
    ];

    $sub_path = substr($path, 13);

    if(preg_match_all('/\/login/', $sub_path)) {
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $user_email = $_POST['email'];
            $user_password = $_POST['password'];
            $user = [
                $user_email,
                $user_password
            ];
            if($user) {
                call_user_func_array($session_routes['/login'], $user);
            }
            else {
                call_user_func($session_routes['404']);
            }
        }
        else {
            echo json_encode('No user');
            exit;
        }
    }
    elseif(preg_match_all('/\/logout/', $sub_path)) {
        if(isset($_GET['uid'])) {
            $user_id = $_GET['uid'];
            call_user_func($session_routes['/logout'], $user_id);
            exit;
        }
        else {
            echo 'Error GET';
            exit;
        }
    }

?>