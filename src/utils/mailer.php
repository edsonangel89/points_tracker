<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'src/libs/PHPMailer/src/Exception.php';
    require 'src/libs/PHPMailer/src/PHPMailer.php';
    require 'src/libs/PHPMailer/src/SMTP.php';

    function send_email($fname, $user_email) {

        $mail = new PHPMailer(true);
        $token = generate_jwt($user_email);

        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'puntoaquaoficial@gmail.com';                     
            $mail->Password   = 'vbkysnwrtngkczzx';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465; 

            $mail->setFrom('puntoaquaoficial@gmail.com', 'Punto Aqua');
            $mail->addAddress($user_email);               
            
            $mail->isHTML(true);                                  
            $mail->Subject = 'Confirmacion de correo electronico';
            $mail->Body    = "
                <h2>Hola " . $fname . "</h2>
                <p>Muchas gracias por registrarte con nosotros</p>
                <p>Oprime el siguiente enlace para confirmar tu correo electrónico:</p>
                <a href=" . "https://www.puntoaqua.com/api/users/update/confirm?email=" . $user_email . "&token=" . $token .">Confirmar correo</a>
                <p>Para soporte técnico manda un mensaje al siguiente correo:</p>
                <a href='mailto:support@libertyws.com.mx'>support@libertyws.com.mx</a>
            ";

            $mail->send();

        }
        catch (Exception $e) {
            echo json_encode('email-no-sent');
            exit;
        }
    }
?>