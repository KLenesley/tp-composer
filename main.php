<?php
require 'vendor/autoload.php';

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Dotenv\Dotenv;

function AddFighter($l, $DATABASE_HOST, $DATABASE_NAME, $DATABASE_TABLE, $DATABASE_USER, $DATABASE_PASS, $DATABASE_PORT, $DATABASE_DIALECT)
{
    try {
        $l->info('Connection réussie');
        $dbh = new PDO("$DATABASE_DIALECT:host=$DATABASE_HOST;port=$DATABASE_PORT;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);

        $stmt = $dbh->prepare("INSERT INTO $DATABASE_TABLE (name, strength, defense) VALUES (:name, :strength, :defense)");

        $name = "Miss Fortune";
        $strength = 100;
        $defense = 50;

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':strength', $strength);
        $stmt->bindParam(':defense', $defense);

        $stmt->execute();
    } catch (PDOException $e) {
        $l->error('Erreur: ' . $e->getMessage());
    }

    // $l->info('Fighter Ajouté');
}

function CheckStrength($strength)
{
    if($strength < 0) {
        throw new Exception('La force du guerrier ne peut pas être négative');
    }
}

print("Premier pas avec la gestion des erreurs (Exepction) \n");

// create a log channel
$log = new Logger('TP-Composer');
$log->pushHandler(new StreamHandler('logs/info.log', Level::Debug));

// Chargement Variable d'environnement
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$log->info('Debut du programme');

// AddFighter($log, $_ENV['DATABASE_HOST'], $_ENV['DATABASE_NAME'], $_ENV['DATABASE_TABLE'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE_PORT'], $_ENV['DATABASE_DIALECT']);

try {
    CheckStrength(-5);
} catch (Exception $e) {
    $log->error('Erreur: ' . $e->getMessage());
}

print ("Fin du programme \n");
?>