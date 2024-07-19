<?php

    function generate_jwt($user_info) {
        $header = json_encode(['type' => 'JWT', 'alg' => 'HS256']);
        $header_base64 = base64_encode($header);
        $payload = json_encode($user_info);
        $payload_base64 = base64_encode($payload);
        $signature = hash_hmac('sha256',"$header_base64.$payload_base64","test", true);
        $signature_base64 = base64_encode($signature);
        return "$header_base64.$payload_base64.$signature_base64";
    }

    function verify_jwt($jwt) {
        list($header_base64, $payload_base64, $signature_received_base64) = explode('.', $jwt);
        $signature_received_base64_urldec = urldecode($signature_received_base64);
        $header_urldecoded = urldecode($header_base64);
        $payload_urldecoded = urldecode($payload_base64);
        $signature_expected = hash_hmac('sha256', "$header_urldecoded.$payload_urldecoded", "test", true);
        $signature_expected_base64 = urldecode(base64_encode($signature_expected));
        if ($signature_received_base64_urldec == $signature_expected_base64) {
            return true;
        } else {
            return false;
        }
    }

?>