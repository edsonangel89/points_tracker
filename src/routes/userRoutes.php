<?php
    
    require 'src/controllers/userControllers.php';
    require 'src/controllers/viewControllers.php';
    require 'src/utils/jwt.php';

    $user_routes = [
        '/' => '',
        '/get/' => 'get_users',
        '/get/id' => 'get_user_by_id',
        '/add/' => 'add_user',
        '/update/info/id' => 'update_user_info_by_id',
        '/update/points/id' => 'update_user_points_by_id',
        '/delete/' => 'delete_user_by_id',
        '404' => 'not_found_page'
    ];

    $sub_path = substr($path, 10);

    if(preg_match_all('/\/get\//', $sub_path)) {
        $user_id = substr($sub_path, 5);
        if($user_id) {
            call_user_func($user_routes['/get/id'], $user_id);
        }
        else {
            call_user_func($user_routes['/get/']);
        }
    }
    elseif(preg_match_all('/\/add/', $sub_path)) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = encrypt_password($_POST['password']);
        $role = $_POST['role'];
        $points = 0;
        $prizes = 0;

        $user = [
            $fname,
            $lname,
            $email,
            $password,
            $role,
            $points,
            $prizes
        ];

        call_user_func_array($user_routes['/add/'], $user);
    }
    elseif(preg_match_all('/\/update\/info\//', $sub_path)) {
        $user_id = substr($sub_path, 13);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        if($user_id) {
            $user = [
                $user_id,
                $fname,
                $lname,
            ];
            if($user_id == 1) {
                http_response_code(400);
            }
            else {
                call_user_func_array($user_routes['/update/info/id'], $user);
            }
        }
        else {
            http_response_code(404);
            call_user_func($user_routes['404']);
        }
    }
    elseif(preg_match_all('/\/update\/points\//', $path)) {
        $user_id = substr($sub_path, 15);
        $user_info = get_points_prizes($user_id);
        $current_points = $user_info['Points'];
        $current_prizes = $user_info['Prizes'];
        $incoming_points = $_POST['points'];
        $total_points = $current_points + $incoming_points;
        if(isset($_COOKIE['Authorization'])) {   
            $jwt_match = verify_jwt($_COOKIE['Authorization']);
            if($jwt_match) {
                if($total_points > 10) {
                    $new_points = $total_points - 11;
                    $current_prizes++;
                }
                else {
                    $new_points = $total_points;
                }
                if($user_id) {
                    $user = [
                        $user_id,
                        $new_points,
                        $current_prizes
                    ];
                    if($user_id == 1) {
                        http_response_code(400);
                    }
                    else {
                        call_user_func_array($user_routes['/update/points/id'], $user);
                    }
                }
                else {
                    http_response_code(404);
                    call_user_func($user_routes['404']);
                }
            }
            else {
                echo 'You dont have authorization';
                exit;
            }
        }
        else {
            echo 'No token';
            exit;
        }
    }
    elseif(preg_match_all('/\/delete\//', $path)) {
        $user_id = substr($sub_path, 8);
        if($user_id) {
            if($user_id == 1) {
                http_response_code(400);
            }
            else {
                call_user_func($user_routes['/delete/'], $user_id);
            }
        }
        else {
            http_response_code(404);
            call_user_func($user_routes['404']);
        }
    }
    else {
        echo 'NOT FOUND';
        call_user_func($user_routes['404']);
    }

?>