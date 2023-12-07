<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Config/database.php';
require_once __DIR__ . '/../app/Config/dataFixtures.php';

session_start();

// DotEnv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function createDb()
{
    $database = new Config\DataBase();
    $database->create();
}

function createDataFixtures()
{
    $dataFixtures = new Config\DataFixtures();
    $dataFixtures->load();
}

if (isset($argv) && in_array('createDb', $argv)) {
    createDb();
}

if (isset($argv) && in_array('createDataFixtures', $argv)) {
    createDataFixtures();
}
