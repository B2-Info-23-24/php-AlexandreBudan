<?php

require_once realpath('./vendor/autoload.php');

// DotEnv
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

// Faker
$faker = Faker\Factory::create();

$servername = $_ENV['DB_SERVERNAME'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Chemin vers le fichier SQL
    $sqlFile = './db.sql';

    // Lit le contenu du fichier SQL
    $sql = file_get_contents($sqlFile);

    // Exécute les requêtes SQL
    $conn->exec($sql);

    echo "Tables créées avec succès\n";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

$conn = null;
