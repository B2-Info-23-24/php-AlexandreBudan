<?php

namespace App;

use Controller\HomeController;
use Controller\LoginController;
use Controller\RegisterController;
use Controller\CarsController;
use Controller\ProfilController;
use Controller\OneCarController;
use Controller\AdminController;
use Entity\User;

class Routeur
{
    public static function routage()
    {
        $request = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($_SESSION['user'])) {
            switch ($request) {
                case '/':
                    HomeController::index();
                    break;
                case '/connexion':
                    switch ($method) {
                        case 'GET':
                            LoginController::index();
                            break;
                        case 'POST':
                            LoginController::post();
                            break;
                    }
                    break;
                case '/inscription':
                    RegisterController::index();
                    break;
                case '/vehicules':
                    CarsController::index();
                    break;
                case '/profil':
                    ProfilController::index();
                    break;
                case '/vehicule':
                    OneCarController::index();
                    break;
                case '/admin':
                    if ($_SESSION['user']->isAdmin) {
                        AdminController::index();
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
                    HomeController::index();
                    break;
                case '/connexion':
                    switch ($method) {
                        case 'GET':
                            LoginController::index();
                            break;
                        case 'POST':
                            LoginController::post();
                            break;
                    }
                    break;
                case '/inscription':
                    RegisterController::index();
                    break;
                case '/vehicules':
                    OneCarController::index();
                    break;
                default:
                    http_response_code(404);
                    echo 'Page not found';
                    break;
            }
        }
    }
}
