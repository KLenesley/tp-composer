<?php
require 'vendor/autoload.php';

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Dotenv\Dotenv;

// Premiers pas avec Composer
print("Premiers pas avec Composer \n \n");

// create a log channel
$log = new Logger('TP-Composer');
$log->pushHandler(new StreamHandler('logs/info.log', Level::Warning));

// Chargement Variable d'environnement
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$log->info('Debut du programme');
$mail = new PHPMailer(true);

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USERNAME'];
    $mail->Password = $_ENV['SMTP_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom($_ENV['SMTP_USERNAME'], $_ENV['SMTP_NAME']);
    $mail->addAddress($_ENV['SMTP_USERNAME'], $_ENV['SMTP_NAME']);
    $mail->Subject = 'TEST';
    $mail->Body    = 'Test D\'envoi de mail avec PHPMailer';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    $log->error('Le message n\'a pas pu être envoyer: ', [$e->getMessage()]);
}

$log->info('Mail envoyé');
?>