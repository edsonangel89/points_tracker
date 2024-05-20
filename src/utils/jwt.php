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
        echo '<br>header_base64 => ' . $header_base64;
        echo '<br>payload_base64 => ' . $payload_base64;
        echo '<br>signature_received_base64 => ' . $signature_received_base64;
        $header_encoded = base64_encode($header_base64);
        echo '<br><br>header_encoded => ' . $header_encoded;
        $header_decoded = base64_decode($header_base64);
        echo '<br>header_decoded => ' . $header_decoded;
        $header_urldecoded = urldecode($header_base64);
        echo '<br>header_urldecoded => ' . $header_urldecoded;

        $payload_encoded = base64_encode($payload_base64);
        echo ' <br>payload_encoded => ' . $payload_encoded;
        $payload_decoded = base64_decode($payload_base64);
        echo ' <br>payload_decoded => ' . $payload_decoded;
        $payload_urldecoded = urldecode($payload_base64);
        echo ' <br>payload_urldecoded => ' . $payload_urldecoded;

        /*$header_decoded = base64_decode($header_encoded);
        echo ' header_decoded => ' . $header_decoded;
        $payload_decoded = base64_decode($payload_encoded);
        echo ' payload_decoded => ' . $payload_decoded;
        */
        $signature_expected = hash_hmac('sha256', "$$header_urldecoded.$payload_base64", "test", true);
        echo '<br>signature_expected => ' . $signature_expected;
        $signature_expected_base64 = base64_encode($signature_expected);
        echo '<br>signature_expected_base64 => ' . $signature_expected_base64;
        

        echo "<br><br>" . $signature_received_base64 . " // " . $signature_expected_base64 ;
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