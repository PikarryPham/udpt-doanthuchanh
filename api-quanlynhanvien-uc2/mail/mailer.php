<?php

require './mail/PHPMailer/src/Exception.php';
require './mail/PHPMailer/src/PHPMailer.php';
require './mail/PHPMailer/src/SMTP.php';
require './mail/PHPMailer/src/OAuth.php';
require './mail/PHPMailer/src/POP3.php';


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

function mail_send_as_content($email,$name,$title,$content){
    $mail = new PHPMailer();

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'pngttrang@gmail.com';                     //SMTP username
        $mail->Password   = 'Trang26102000';                          //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = "tls";
        $mail->CharSet = "UTF-8";

        //Recipients
        $mail->setFrom('changpham1026@gmail.com', 'Trang Phạm');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

