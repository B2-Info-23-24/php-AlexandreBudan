<?php

require_once __DIR__ . '/../vendor/autoload.php';

# Initialisation de Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

$request = $_SERVER['REQUEST_URI'];
session_start();
if (isset($_SESSION['user'])) { // Set une session du User
    switch ($request) {
        case '/profil':
            require './src/View/profil.php';
            break;
        case '/car':
            require './src/View/car.php';
            break;
        case '/admin':
            if ($_SESSION['user']) { //Faire le verif Admin
                require './src/View/admin.php';
            } else {
                http_response_code(404);
                echo 'Page not found';
            }
            break;
        default:
            http_response_code(404);
            echo 'Page not found';
            break;
    }
} else {
    switch ($request) {
        case '/':
            require './src/View/home.php';
            break;
        case '/login':
            require './src/View/login.php';
            break;
        case '/register':
            require './src/View/register.php';
            break;
        default:
            http_response_code(404);
            echo 'Page not found';
            break;
    }
}
