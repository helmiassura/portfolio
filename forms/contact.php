<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'helmi.lf123@gmail.com';
    $mail->Password   = 'jchgyyxpnivqqaen';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!$name || !$email || !$subject || !$message) {
        http_response_code(400);
        echo "Semua field wajib diisi.";
        exit;
    }

    // Set email
    $mail->setFrom($email, $name);
    $mail->addAddress('lerkud600@gmail.com'); 
    $mail->Subject = $subject;
    $mail->Body    = "Dari : $email \n\nNama : $name\n\nPesan : $message";

    $mail->send();
    echo "OK";
} catch (Exception $e) {
    http_response_code(500);
    echo "Gagal mengirim pesan. Error: {$mail->ErrorInfo}";
}
