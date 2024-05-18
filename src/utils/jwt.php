<?php

    function generate_jwt($user_info) {
        $header = json_encode(['type' => 'JWT', 'alg' => 'HS256']);
        $header_base64 = base64_encode($header);
        $payload = json_encode(['email' => $user_info]);
        $payload_base64 = base64_encode($payload);
        $signature = hash_hmac('sha256',"$header_base64.$payload_base64","test", true);
        $signature_base64 = base64_encode($signature);
        return "$header_base64.$payload_base64.$signature_base64";
    }

    function verify_jwt($jwt) {
        list($header_base64, $payload_base64, $signature_received_base64) = explode('.', $jwt);
        $header = base64_decode($header_base64);
        $payload = base64_decode($payload_base64);
        echo $header;
        echo $payload;
        exit;
        $signature_expected = hash_hmac('sha256', "$header_base64.$payload_base64", "test", true);
        $signature_expected_base64 = base64_encode($signature_expected);

        //echo json_encode($signature_received_base64 . " // " . $signature_expected_base64);

        /*if ($signature_received_base64 === $signature_expected_base64) {
            return true;
        } else {
            return false;
        }*/
    }

    verify_jwt('test');

?>