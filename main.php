<?php
require 'vendor/autoload.php';

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Dotenv\Dotenv;

function AddFighter($l)
{

    $l->info('Fighter Successfully added');

}

// Premiers pas avec Composer
print("Premiers pas avec Composer \n \n");

// create a log channel
$log = new Logger('TP-Composer');
$log->pushHandler(new StreamHandler('logs/info.log', Level::Warning));

// Chargement Variable d'environnement
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$log->info('Debut du programme');

AddFighter($log);

?>