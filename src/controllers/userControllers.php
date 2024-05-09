<?php

    require 'src/models/userModels.php';

    $server_db = 'localhost';
    $user_db = 'root';
    $password_db = '';
    $name_db = 'pointstrackerdb';
    $name_users_table = 'users';

    function get_users() {
        $users = User::get_users();
        http_response_code(200);
        echo json_encode($users);
    }

    function get_user_by_id($uid) {
        $user = User::get_user_by_id($uid);
        http_response_code(200);
        echo json_encode($user);
    }

    function get_user_by_email($email) {
        $user = User::get_user_by_email($email);
        if($user) {
            return $user;
        }
        else {
            return false;
        }
    }

    function add_user($fname, $lname, $email, $password, $role, $points, $prizes) {
        $create = User::add_user($fname, $lname, $email, $password, $role, $points, $prizes);
        if($create) {
            http_response_code(201);
        }
        else {
            http_response_code(400);
        }
        
    }

    function update_user_info_by_id($uid, $fname, $lname) {
        User::update_user_info($uid, $fname, $lname);
        http_response_code(200);
    }

    function update_user_points_by_id($uid, $points, $prizes) {
        User::update_user_points($uid, $points, $prizes);
        http_response_code(200);
    }

    function get_points_prizes($uid) {
        $user_points = User::get_points_prizes($uid);
        return $user_points;
    }

    function delete_user_by_id($uid) {
        User::delete_user($uid);
        http_response_code(200);
    }

?>