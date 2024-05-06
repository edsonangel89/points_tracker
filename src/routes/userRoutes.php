<?php
    
    require 'src/controllers/userControllers.php';
    require 'src/controllers/viewControllers.php';

    $user_routes = [
        '/' => '',
        '/get' => 'get_users',
        '/get/' => 'get_user_by_id',
        '/add' => '',
        '/update' => 'update',
        '/delete' => 'delete',
        '404' => 'not_found_page'
    ];

    $sub_path = substr($path, 10, 5);

    if(preg_match_all('/\/get/', $path) && $sub_path == '/get') {
        call_user_func($user_routes[$sub_path]);
    }
    elseif(preg_match_all('/\/get\//', $path) && $sub_path == '/get/') {
        $user_id = substr($path, 15);
        if($user_id) {
            call_user_func($user_routes[$sub_path], $user_id);
        }
        else {
            echo 'no id';
        }
    }
    elseif(preg_match('/\/update/', $path) || preg_match('/\/delete/', $path)) {
        $user_id = substr($path, 18);
        $sub_path = substr($path, 10,8);
        echo $user_routes[$sub_path];
    }
    else {
        call_user_func($user_routes['404']);
    }

    //echo $user_id;
    /*if(preg_match('/[0-9]/', $user_id)) {
        echo 'YES';
    }
    else {
        echo 'NO';
        $user_routes['404'];
    }*/

?>