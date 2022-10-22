<?php

// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$email = $_POST['email'];
$name = $_POST['name'];
$company = $_POST['company'];

$title = "New mail from visual layer";
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
    $mail->Host       = 'mail.hayfever.games'; // SMTP сервера вашей почты
    $mail->Username   = 'admin@hayfever.games'; // Логин на почте
    $mail->Password   = '6u*XM]A7i_k3'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('wordpress@visual.layer', $hfname); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('vaholes570@cadolls.com');
    
    //echo $body;

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    
    
    // Проверяем отравленность сообщения
    if ($mail->send()) {
        echo 'success';
        $result = "success";
        exit;
    } 
    else {
        $result = "error";
    }
} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
    echo $status;
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