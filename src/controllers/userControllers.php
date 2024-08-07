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
        /*$token = generate_jwt($email);
        $token_match = verify_jwt($token);*/
        /*echo json_encode($token_match);
        exit;*/
        /*$user_info = [
            $email,
            $token
        ];*/
        /*if($token_match) {*/
        $user_info = [
            $email
        ];
            send_email($fname, $email);
                $create = User::add_user($fname, $lname, $email, $password, $role, $points, $prizes, $verify);
                if($create) {
                    notification();
                    http_response_code(201);
                    header("Cache-Control: no-cache");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                    echo json_encode($user_info);
                }
                else {
                    http_response_code(400);
                    echo json_encode('user-no-added');
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
        $update = User::update_user_points($uid, $points, $prizes);
        if($update) {
            $user = User::get_user_by_id($uid);
            http_response_code(200);
            echo json_encode($user);
        }
        else {
            http_response_code(401);
        }
    }

    function get_points_prizes($uid) {
        $user_points = User::get_points_prizes($uid);
        return $user_points;
    }

    function update_user_prize_by_id($uid, $prize) {
        $update = User::update_user_prize($uid, $prize);
        if($update) {
            $user = User::get_user_by_id($uid);
            http_response_code(200);
            echo json_encode($user);
        }
        else {
            http_response_code(401);
        }
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
        if($match) {
            User::update_email_verify(urldecode($email));
            http_response_code(200);
            header("Location: /succeed?email=" . $email. "&token=" . $token . "");
        }
        else {
            http_response_code(400);
            echo json_encode('email-no-verified');
        }
    }
?>