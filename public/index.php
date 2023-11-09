<?php

require_once __DIR__ . '/../vendor/autoload.php';

# Initialisation de Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

// Routeur simple
$path = $_SERVER['REQUEST_URI'];
switch ($path) {
    case '/':
        require_once __DIR__ . '/../src/Controller/HomeController.php';
        // $controller = new HomeController($twig);
        // $controller->indexAction();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}

require_once __DIR__ . '/../src/routes.php';
