<?php

    require 'src/controllers/userControllers.php';
    require 'src/utils/jwt.php';

    function login($username, $password) {
        $user = get_user_by_email($username);
        if($user) {
            $user_db_password = $user['Password'];
            $user_db_email = $user['Email'];
            if(decrypt_password($password, $user_db_password)) {
                if($user['Role'] == 'superadmin') {
                    $jwt = generate_jwt($user_db_email);
                    setcookie('Authorization', "$jwt", time() + 3600,"/",false, true);
                    echo json_encode($jwt);
                }
                else {
                    http_response_code(200);
                }
            }
        }
        else {
            http_response_code(400);
            echo json_encode('Failed login');
        }
    }

    function logout($uid) {
        $user = User::get_user_by_id($uid);
        if($user) {
            setcookie('Authorization', "", time() - 3600,"/",false, true);
            header('Location: /checker');
        }
        else {
            http_response_code(404);
            echo 'No user';
        }
    }

?>