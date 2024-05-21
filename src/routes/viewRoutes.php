<?php

    require 'src/controllers/viewControllers.php';

    $views_routes = [
        '/home' => 'get_home',
        '/login' => 'get_login',
        '/sign' => 'get_sign',
        '/info' => 'get_info',
        '/mail' => 'get_confirm',
        '/succeed' => 'get_succeed',
        '/confirm' => 'confirm',
        '/jwt' => 'get_jwt_verify'
    ];

    if(array_key_exists($path, $views_routes)) {
        if(isset($_SESSION['ROLE'])) {
            if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'superadmin') {
                call_user_func($views_routes[$path], 'admin');
            }
            elseif ($_SESSION['ROLE'] == 'user') {
                call_user_func($views_routes[$path], 'user');
            }
        }
        else {
            call_user_func($views_routes[$path], 'nouser');
        }
    }
    /*elseif (preg_match_all('/mail', $path)) {
        call_user_func($views_routes['/mail']);
    }*/
    elseif(array_key_exists($path, $views_routes)) {
        call_user_func($views_routes[$path]);
    }
    else {
        require 'src/views/404.php';
    }

?>