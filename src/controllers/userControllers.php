<?php

    require 'src/models/userModels.php';
    require 'src/utils/mailer.php';

    function get_users() {
        $users = User::get_users();
        if($users) {
            http_response_code(200);
            echo json_encode($users);
        }
        else {
            http_response_code(404);
            echo json_encode('Non-users');
        }
    }

    function get_user_by_id($uid) {
        $user = User::get_user_by_id($uid);
        if($user) {
            http_response_code(200);
            echo json_encode($user);
        }
        else {
            http_response_code(404);
            echo json_encode('Non-user');
        }
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

    function add_user($fname, $lname, $email, $password, $role, $points, $prizes, $verify) {
        $create = User::add_user($fname, $lname, $email, $password, $role, $points, $prizes, $verify);
        if($create) {
            http_response_code(201);
            send_email($email);
            //header(': /mail');
            //header('Location: /mail');
            $token = generate_jwt($email);
            $token_match = verify_jwt($token);
            $user_info = [
                $email,
                $token
            ];
            //echo json_encode('User added');
            if($token_match) {
                http_response_code(201);
                echo json_encode('New-user-added');
            }
            else {
                echo json_encode('Non-token');
            }
        }
        else {
            http_response_code(400);
        }
        
    }

    function update_user_info_by_id($uid, $fname, $lname) {
        $update = User::update_user_info($uid, $fname, $lname);
        if($update) {
            http_response_code(200);
            echo json_encode('user-updated');
        }
        else {
            http_response_code(400);
        }
        
    }

    function update_user_points_by_id($uid, $points, $prizes) {
        $user = User::update_user_points($uid, $points, $prizes);
        if($user) {
            http_response_code(200);
            echo json_encode('user-points');
        }
        else {
            http_response_code(401);
        }
    }

    function get_points_prizes($uid) {
        $user_points = User::get_points_prizes($uid);
        return $user_points;
    }

    function delete_user_by_id($uid) {
        $is_user = User::get_user_by_id($uid);
        if($is_user) {
            if($uid == 1) {
                http_response_code(400);
                echo json_encode('Non-deleted');
            }
            else {
                $is_deleted = User::delete_user($uid);
                if($is_deleted) {
                    http_response_code(200);
                    echo json_encode('Deleted');
                }
                else {
                    http_response_code(400);
                    echo json_encode('Non-deleted');
                }
            }
        }
        else {
            http_response_code(404);
            echo json_encode('Non-user');
        }
    }

    function confirm_email($email, $token) {
        $match = verify_jwt($token);
        $is_email_verify = User::update_email_verify($email);
        if($match && $is_email_verify) {
            http_response_code(200);
            header("Location: /checker/succeed?email=$email&token=$token");
        }
        else {
            http_response_code(400);
            return false;
        }
    }

?>