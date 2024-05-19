<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'src/libs/PHPMailer/src/Exception.php';
    require 'src/libs/PHPMailer/src/PHPMailer.php';
    require 'src/libs/PHPMailer/src/SMTP.php';
    //require 'src/utils/jwt.php';

    function send_email($user_email) {

        $mail = new PHPMailer(true);
        $token = generate_jwt($user_email);

        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'puntoaquaoficial@gmail.com';                     //SMTP username
            $mail->Password   = 'vbkysnwrtngkczzx';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465; 

            //Recipients
            $mail->setFrom('puntoaquaoficial@gmail.com', 'Punto Aqua');
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress($user_email);               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Confirmacion de correo electronico';
            $mail->Body    = "
                <p>Oprime el siguiente enlace para confirmar tu correo electronico</p>
                <a href=" . "https://www.puntoaqua.com/api/users/update/confirm?email=" . $user_email . "&token=" . $token .">Confirmar correo</a>
            ";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

        }
        catch (Exception $e) {
            echo json_encode('Email not sent');
            //echo $e->GetMessage();
        }
    }
?>