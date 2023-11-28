<?php

require_once("../vendor/autoload.php");
require_once("../app/routes.php");
require_once("../app/Config/database.php");
require_once("../app/Config/dataFixtures.php");

session_start();

// DotEnv
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

// Routeur
App\Routeur::routage();

if (!isset($_SESSION['on'])) {
    // Database
    $database = new Config\DataBase();
    $database->create();
    $dataFixtures = new Config\DataFixtures();
    $dataFixtures->load();

    $_SESSION['on'] = true;
}
