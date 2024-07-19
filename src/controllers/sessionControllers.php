<?php

    require 'src/controllers/userControllers.php';
    require 'src/utils/jwt.php';

    function login($username, $password) {
        $user = get_user_by_email($username);
        if($user) {
            $user_db_id = $user['UserID'];
            $user_db_fname = $user['FirstName'];
            $user_db_lname = $user['LastName'];
            $user_db_password = $user['Password'];
            $user_db_email = $user['Email'];
            $user_db_role = $user['Role'];
            $user_db_points = $user['Points'];
            $user_db_prize = $user['Prize'];
            if(decrypt_password($password, $user_db_password)) {
                if($user['EmailVerified']) {
                    if(!isset($_SESSION['ID'])) {
                        $_SESSION['ID'] = $user_db_id;
                        $_SESSION['FNAME'] = $user_db_fname;
                        $_SESSION['LNAME'] = $user_db_lname;
                        $_SESSION['EMAIL'] = $user_db_email;
                        $_SESSION['ROLE'] = $user_db_role;
                        $_SESSION['POINTS'] = $user_db_points;
                        $_SESSION['PRIZE'] = $user_db_prize;
                        if($_SESSION['ROLE'] == 'superadmin') {
                            $user_info = [
                                "email" => $user_db_email,
                                "role" => $user_db_role
                            ];
                            $jwt = generate_jwt($user_info);
                            setcookie('auth_token', "$jwt", time() + 43200,"/","",true, true);
                            echo json_encode($user);
                        }
                        elseif ($_SESSION['ROLE'] == 'user'){
                            $user_info = [
                                "email" => $user_db_email,
                                "role" => $user_db_role
                            ];
                            $jwt = generate_jwt($user_info);
                            setcookie('auth_token', "$jwt", time() + 604800,"/","",true, true);
                            echo json_encode($user);
                        }
                    }
                    else {
                        if($_SESSION['ID'] == $user_db_id) {
                            http_response_code(200);
                            echo json_encode($user);
                        }
                        else {
                            http_response_code(400);
                            echo json_encode('Login error');    
                        }
                        
                    }
                }
                else {
                    echo json_encode('Non-verified');
                    http_response_code(400);
                }
            }
            else {
                http_response_code(400);
                echo json_encode('Wrong-password');
            }
            }
        else {
            http_response_code(404);
            echo json_encode('Non-user');
        }
    }

    function logout($uid) {
        $user = User::get_user_by_id($uid);
        session_start();
        if($user && isset($_SESSION['ID'])) {
            if($_SESSION['ID'] == 1) {
                setcookie('Authorization', "", time() - 3600,"/",false, true);
            }
            elseif($_SESSION['ID'] > 1) {
                setcookie('User', "", time() - 3600,"/",false, true);
            }
            session_destroy();
            header('Location: /');
        }
        else {
            http_response_code(404);
            echo 'Non-user';
        }
    }

    function user($session_id) {
        $user = User::get_user_by_id($session_id);
        if($user) {
            http_response_code(200);
            echo json_encode($user);
        }
        else {
            http_response_code(404);
            echo 'Non-user';
        }
    }

?>
