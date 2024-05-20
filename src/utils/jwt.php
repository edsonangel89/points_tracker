<?php

    function generate_jwt($user_info) {
        $header = json_encode(['type' => 'JWT', 'alg' => 'HS256']);
        $header_base64 = base64_encode($header);
        $payload = json_encode($user_info);
        $payload_base64 = base64_encode($payload);
        $signature = hash_hmac('sha256',"$header_base64.$payload_base64","test", true);
        $signature_base64 = base64_encode($signature);
        //echo $signature_base64 . "\n";
        return "$header_base64.$payload_base64.$signature_base64";
    }

    function verify_jwt($jwt) {
        //echo 'jwt => ' . $jwt . "\n";
        list($header_base64, $payload_base64, $signature_received_base64) = explode('.', $jwt);
        echo 'jwt => ' . $header_base64;
        echo 'jwt => ' . $payload_base64;
        echo 'jwt => ' . $signature_received_base64;
        $header = base64_encode($header_base64);
        $header_encoded = base64_decode($header);
        $payload = base64_encode($payload_base64);
        $payload_encoded = base64_decode($payload);

        $header_decoded = base64_decode($header_encoded);
        $payload_decoded = base64_decode($payload_encoded);

        $signature_expected = hash_hmac('sha256', "$header_base64.$payload_base64", "test", true);
        $signature_expected_base64 = base64_encode($signature_expected);

        

        //echo $signature_received_base64 . " // " . $signature_expected_base64 ;
        //exit;
        if ($signature_received_base64 == $signature_expected_base64) {
            return true;
            //echo json_encode('EQUAL');
            //exit;
            //echo 'equal';
        } else {
            return false;
            //echo json_encode($signature_received_base64 . " // " . $signature_expected_base64);
            //exit;
            //echo 'no equal';
        }
        
    }

?>