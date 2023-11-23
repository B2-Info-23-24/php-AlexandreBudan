<?php

namespace Config;

use PDO;
use PDOException;

class DataBase
{
    public static function connect()
    {

        $servername = $_ENV['DB_SERVERNAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }

    public static function create()
    {

        try {
            $conn = self::connect();
            // Chemin vers le fichier SQL
            $sqlFile = '../db.sql';

            // Lit le contenu du fichier SQL
            $sql = file_get_contents($sqlFile);

            // Exécute les requêtes SQL
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }
}
