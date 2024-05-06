<?php

    function encrypt_password($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    function decrypt_password($user_password, $db_password) {
        $match = password_verify($user_password, $db_password);
        return $match;
    }

?>