<?php

    function validate_email($email) {
        $email = trim($email);
        $email = stripcslashes($email);
        $email = htmlspecialchars($email);
        $email = strtolower($email);
        if(preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]/', $email)) {
            return $email;
        }
        else {
            return false;
        }
    }

    function validate_password($password) {
        $password = trim($password);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
        if(preg_match_all('/[a-zA-Z0-9]/', $password)) {
            return $password;
        }
        else {
            return false;
        }
    }

    function validate_text_input($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        if(preg_match_all('/[a-zA-Z]/', $input)) {
            return $input;
        }
        else {
            return false;
        }
    }

?>