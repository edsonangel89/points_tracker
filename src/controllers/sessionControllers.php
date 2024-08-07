<?php

    require 'src/controllers/userControllers.php';

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
                        if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'superadmin') {
                            $user_info = [
                                'email' => "$user_db_email",
                                'role' => "$user_db_role"
                            ];
                            $jwt = generate_jwt($user_info);
                            $crypted_jwt = encrypt_jwt($jwt);
                            $user_db_info = [
                                "UserID" => $user_db_id,
                                "FirstName" => $user_db_fname,
                                "LastName" => $user_db_lname,
                                "Email" => $user_db_email,
                                "Role" => $user_db_role,
                                "Points" => $user_db_points,
                                "Prize" => $user_db_prize,
                                "Token" => $crypted_jwt
                            ];
                            header("Authorization: Bearer $crypted_jwt");
                            setcookie('auth_token', "$crypted_jwt", time() + 43200,"/","",true, true);
                            echo json_encode($user_db_info);
                        }
                        elseif ($_SESSION['ROLE'] == 'user'){
                            $user_info = [
                                'email' => "$user_db_email",
                                'role' => "$user_db_role"
                            ];
                            $jwt = generate_jwt($user_info);
                            $crypted_jwt = encrypt_jwt($jwt);
                            $user_db_info = [
                                "UserID" => $user_db_id,
                                "FirstName" => $user_db_fname,
                                "LastName" => $user_db_lname,
                                "Email" => $user_db_email,
                                "Role" => $user_db_role,
                                "Points" => $user_db_points,
                                "Prize" => $user_db_prize,
                                "Token" => $crypted_jwt
                            ];
                            header("Authorization: Bearer $crypted_jwt");
                            setcookie('auth_token', "$crypted_jwt", time() + 604800,"/","",true, true);
                            echo json_encode($user_db_info);
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
        session_destroy();
        header('Location: /');
        if($user && isset($_SESSION['ID'])) {
            if($_SESSION['ID'] == 1) {
                setcookie('auth_token', "", time() - 3600,"/","",true, true);
            }
            elseif($_SESSION['ID'] > 1) {
                setcookie('auth_token', "", time() - 3600,"/","",true, true);
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
