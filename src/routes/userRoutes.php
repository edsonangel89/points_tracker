<?php
    
    require 'src/controllers/userControllers.php';
    require 'src/controllers/viewControllers.php';
    /*require 'src/utils/jwt.php';*/
    require 'src/utils/inputValidation.php';

    $user_routes = [
        '/' => '',
        '/get/' => 'get_users',
        '/get/id' => 'get_user_by_id',
        '/get/email' => 'get_user_by_email',
        '/add/' => 'add_user',
        '/update/info/id' => 'update_user_info_by_id',
        '/update/points/id' => 'update_user_points_by_id',
        '/update/prize/id' => 'update_user_prize_by_id',
        '/update/confirm' => 'confirm_email',
        '/delete/' => 'delete_user_by_id',
        '404' => 'not_found_page'
    ];
    


    $sub_path = substr($path, 10);
    
    if(!$sub_path || $sub_path == '/') {
        echo json_encode($sub_path);
        call_user_func($user_routes['404']);
    }

    $headers = getallheaders();

    if(preg_match_all('/\/get\//', $sub_path)) {
        $user_id = substr($sub_path, 5);
        $headers = getallheaders();
        if(!$user_id) {
            if(isset($_SESSION['ID']) && isset($_COOKIE['auth_token'])) {
                if(isset($_SESSION['ROLE'])) {
                    if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'superadmin') {
                        call_user_func($user_routes['/get/']);
                    }
                } 
                http_response_code(401);
                echo json_encode('Non-Authorized');
            }
            else {
                call_user_func($user_routes['404']);
            }
        }
        else {
            $headers = getallheaders();
            $auth_header = $headers['Authorization'];

            if(isset($_SESSION['ID']) && isset($_SESSION['ROLE']) || $auth_header) {
                
                $token = substr($headers['Authorization'], 7);
                $is_token_correct = verify_jwt($token);
                
                if($_SESSION['ID'] == $user_id || $_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'superadmin' || $is_token_correct) {
                    call_user_func($user_routes['/get/id'], $user_id);
                }
                else {
                    http_response_code(401);
                    echo json_encode('Non-Authorized');
                }
            }
            else {
                if($user_id == 'email') {
                    if(isset($_POST['email'])) {
                        $user_email = validate_email($_POST['email']);
                        echo json_encode(call_user_func($user_routes['/get/email'], $user_email));
                    }
                }
                else {
                    call_user_func($user_routes['404']);
                }
            }
        }
    }
    elseif(preg_match_all('/\/add/', $sub_path)) {
        $fname = validate_text_input($_POST['fname']);
        $lname = validate_text_input($_POST['lname']);
        $email = validate_email($_POST['email']);
        $password = encrypt_password(validate_password($_POST['password']));
        $role = 'user';
        $points = 0;
        $prizes = 0;
        $verify = false;

        $user = [
            $fname,
            $lname,
            $email,
            $password,
            $role,
            $points,
            $prizes,
            $verify
        ];
        call_user_func_array($user_routes['/add/'], $user);
    }
    elseif(preg_match_all('/\/update\/info\//', $sub_path)) {
        $user_id = substr($sub_path, 13);
        $fname = validate_text_input($_POST['fname']);
        $lname = validate_text_input($_POST['lname']);
        if(!isset($_SESSION['ID'])) {
            http_response_code(401);
            call_user_func($user_routes['404']);
        }
        if($user_id && $user_id == $_SESSION['ID']) {
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
    elseif(preg_match_all('/\/update\/confirm/', $sub_path)) {
        if(isset($_GET['email'])) {
            $email = urlencode($_GET['email']);
            $user_info = [
                $email
            ];
            call_user_func_array($user_routes['/update/confirm'], $user_info);
        }
        else {
            http_response_code(404);
            echo json_encode('Non-user');
        }
    }   
    elseif(preg_match_all('/\/update\/points\//', $sub_path) && $_SESSION['ROLE'] == 'superadmin' || isset($headers['Authorization'])) {
        $user_id = substr($sub_path, 15);
        $user_info = get_points_prizes($user_id);
        $current_points = $user_info['Points'];
        $current_prize = $user_info['Prize'];
        $incoming_points = $_POST['points'];
        $total_points = $current_points + $incoming_points;
        $headers = getallheaders();
        if(isset($_COOKIE['auth_token']) || isset($headers['Authorization'])) {   
            $user_bearer_auth = $headers['Authorization'];
            $user_token_auth = $user_bearer_auth;
            $token = substr($headers['Authorization'], 7);
            if ($token) {
                $is_correct_jwt = verify_jwt($token);
                $auth_token = get_jwt_info($token);
            }
            $jwt_match = verify_jwt($_COOKIE['auth_token']);
            $user_role = get_jwt_info($_COOKIE['auth_token']);
            if(($jwt_match && ($user_role == 'admin' || $user_role == 'superadmin' )) || ($auth_token == 'admin' || $auth_token == 'superadmin')) {
                if($total_points > 10) {
                    $new_points = $total_points - 11;
                    $current_prize = true;
                }
                else {
                    $new_points = $total_points;
                }
                if($user_id) {
                    $user = [
                        $user_id,
                        $new_points,
                        $current_prize
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
                http_response_code(401);
                echo json_encode('Non-authorized');
            }
        }
        else {
            http_response_code(404);
            echo json_encode('Non-token');
        }
    }
    elseif(preg_match_all('/\/update\/prize\//', $sub_path) && $_SESSION['ROLE'] == 'superadmin' || isset($headers['Authorization'])) {
        $user_id = substr($sub_path, 14);
        $user_info = get_points_prizes($user_id);
        $current_prize = $user_info['Prize'];
        if(isset($_COOKIE['auth_token']) || isset($headers['Authorization'])) {   
            $jwt_match1 = verify_jwt($_COOKIE['auth_token']);
            $jwt_match2 = verify_jwt($headers['Authorization']);
            if($jwt_match1 || $jwt_match2) {
                if($current_prize) {
                    $current_prize = false;
                }
                else {
                    $current_prize = $current_prize;
                }
                if($user_id) {
                    $user = [
                        $user_id,
                        $current_prize
                    ];
                    if($user_id == 1) {
                        http_response_code(400);
                    }
                    else {
                        call_user_func_array($user_routes['/update/prize/id'], $user);
                    }
                }
                else {
                    http_response_code(404);
                    call_user_func($user_routes['404']);
                }
            }
            else {
                http_response_code(401);
                echo json_encode('Non-authorized');
            }
        }
        else {
            http_response_code(404);
            echo json_encode('Non-token');
        }
    }
    elseif(preg_match_all('/\/delete\//', $sub_path)) {
        $user_id = substr($sub_path, 8);
        if($user_id && $_SESSION['ID'] == $user_id) {
            call_user_func($user_routes['/delete/'], $user_id);
        }
        elseif($user_id && $_SESSION['ID'] == 1) {
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
        http_response_code(404);
        call_user_func($user_routes['404']);
    }

?>