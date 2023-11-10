<?php

require_once __DIR__ . '/../vendor/autoload.php';

# Initialisation de Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

$request = $_SERVER['REQUEST_URI'];
session_start();
if (isset($_SESSION['email'])) {
    switch ($request) {
        case '/':
            require __DIR__ . '/../src/View/home.html';
            break;
        default:
            http_response_code(404);
            echo 'Page not found';
            break;
    }
} else {
    switch ($request) {
        case '/':
            require __DIR__ . '/../src/View/home.html';
            break;
        default:
            http_response_code(404);
            echo 'Page not found';
            break;
    }
}
