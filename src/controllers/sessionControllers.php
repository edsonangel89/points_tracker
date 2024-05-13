<?php

    require 'src/controllers/userControllers.php';
    require 'src/utils/jwt.php';

    function login($username, $password) {
        $user = get_user_by_email($username);
        if($user) {
            $user_db_password = $user['Password'];
            $user_db_email = $user['Email'];
            if(decrypt_password($password, $user_db_password)) {
                if($user['EmailVerified']) {
                    session_start();
                    if(!isset($_SESSION['ID'])) {
                        $_SESSION['ID'] = $user['UserID'];
                        $_SESSION['FNAME'] = $user['FirstName'];
                        $_SESSION['LNAME'] = $user['LastName'];
                        $_SESSION['EMAIL'] = $user['Email'];
                        $_SESSION['ROLE'] = $user['Role'];
                        $_SESSION['POINTS'] = $user['Points'];
                        if($_SESSION['ROLE'] == 'superadmin') {
                            $jwt = generate_jwt($user_db_email);
                            setcookie('Authorization', "$jwt", time() + 3600,"/",false, true);
                            echo json_encode('superadmin-logged');
                        }
                        elseif ($_SESSION['ROLE'] == 'user'){
                            echo json_encode('user-logged');
                        }
                    }
                    else {
                        http_response_code(400);
                        echo json_encode('user-already-logged');
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
            setcookie('Authorization', "", time() - 3600,"/",false, true);
            session_destroy();
            header('Location: /checker');
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