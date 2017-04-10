<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 2/26/2017 AD
 * Time: 18:11
 */


date_default_timezone_set('Asia/Bangkok');
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->CharSet = "utf-8";
$mail->Host = "smtp.live.com";
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "jtoosystem@hotmail.com";
$mail->Password = "dev-2560";
$mail->setFrom('jtoosystem@hotmail.com', 'ระบบสารสนเทศการนิเทศนักศึกษาฝึกงาน');

//$mail->addAddress('jakkrit2939@gmail.com');
//$mail->Subject = 'แจ้งเตือน การเข้าไปนิเทศนักศึกษาฝึกงาน';
////$mail->msgHTML(file_get_contents('content.html'), dirname(__FILE__));
//$mail->msgHTML("มีนัดหมายการนิเทศนักศึกษาฝึกงาน ที่  วันที่  เวลา");

//if (!$mail->send()) {
//    echo "Mailer Error: " . $mail->ErrorInfo;
//} else {
//    echo "Message sent!";
//}
?>