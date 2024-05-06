<?php
    session_start();

    require 'src/controllers/viewControllers.php';

    $views_routes = [
        '/home' => 'get_home',
    ];

    if(array_key_exists($path, $views_routes)) {
        if($_SESSION) {
            if($_SESSION['role'] == 'admin') {
                call_user_func($views_routes[$path], 'admin');
            }
            elseif ($_SESSION['role'] == 'user') {
                call_user_func($views_routes[$path], 'user');
            }
        }
        else {
            call_user_func($views_routes[$path], 'nouser');
        }
    }
    else {
        require 'src/views/404.php';
    }

?>