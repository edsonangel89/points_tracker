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
        //echo 'jwt => ' . $jwt;
        list($header_base64, $payload_base64, $signature_received_base64) = explode('.', $jwt);
        $header = base64_encode($header_base64);
        $header_encoded = base64_decode($header);
        $payload = base64_encode($payload_base64);
        $payload_encoded = base64_decode($payload);
        $signature_expected = hash_hmac('sha256', "$header_encoded.$payload_encoded", "test", true);
        $signature_expected_base64 = base64_encode($signature_expected);

        $header_decoded = base64_decode($header_encoded);
        $payload_decoded = base64_decode($payload_encoded);

        echo json_encode($header_decoded . " // " . $payload_decoded);
        exit;
        /*if ($signature_received_base64 === $signature_expected_base64) {
            return true;
            //echo json_encode($signature_received_base64 . " // " . $signature_expected_base64);
            //exit;
            //echo 'equal';
        } else {
            return false;
            //echo json_encode($signature_received_base64 . " // " . $signature_expected_base64);
            //exit;
            //echo 'no equal';
        }*/
        
    }

?>