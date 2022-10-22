<?php

// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$email = $_POST['email'];
$name = $_POST['name'];
$company = $_POST['company'];

$title = "New mail from APEXAVERSE";
$body = "
<b>Email:</b> $email<br>
<b>Name:</b> $name<br>
<b>Company:</b> $company<br>
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'premium233.web-hosting.com'; // SMTP сервера вашей почты
    $mail->Username   = 'no-reply@apexaverse.com'; // Логин на почте
    $mail->Password   = 'rmH.DB6Y]HCr'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('no-reply@apexaverse.com', 'Apexaverse'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('landing@visual-layer.com');
    
    echo $body;

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    
    
    // Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}
    
} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}
    
$addr = $_SERVER['HTTP_REFERER'];
$addr = str_replace('av_mail_responce=true', '', $addr);
$addr = str_replace('?av_mail_responce=false', '', $addr);
$concat = '';

if($result == 'success'){
    $concat = '?av_mail_responce=true';
    header('Location: ' . $addr . $concat);
    exit;
} else {
    $concat = '?av_mail_responce=false';
    header('Location: ' . $addr . $concat);
    exit;
}