<?php

namespace App;

use Controller\HomeController;
use Controller\LoginController;
use Controller\RegisterController;
use Controller\CarsController;
use Controller\ProfilController;
use Controller\OneCarController;
use Controller\AdminController;

class Routeur
{
    public static function routage()
    {
        $request = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($_SESSION['user'])) {
            switch ($request) {
                case '/':
                    switch ($method) {
                        case 'GET':
                            $controller = new HomeController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new HomeController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/connexion':
                    switch ($method) {
                        case 'GET':
                            $controller = new LoginController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new LoginController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/inscription':
                    switch ($method) {
                        case 'GET':
                            $controller = new RegisterController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new RegisterController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/profil':
                    switch ($method) {
                        case 'GET':
                            $controller = new ProfilController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new ProfilController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/admin':
                    if ($_SESSION['user']->getIsAdmin()) {
                        switch ($method) {
                            case 'GET':
                                $controller = new AdminController();
                                $controller->index();
                                break;
                            case 'POST':
                                $controller = new AdminController();
                                $controller->post();
                                break;
                        }
                    } else {
                        http_response_code(404);
                        echo 'Page not found';
                    }
                    break;
                case '/reservation/' . explode("/", $_SERVER['REQUEST_URI'])[2]:
                    switch ($method) {
                        case 'GET':
                            $controller = new CarsController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new CarsController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/reservation/' . $_SESSION['reservation']->getHash() . '/' . explode("/", $_SERVER['REQUEST_URI'])[3] . '/' . explode("/", $_SERVER['REQUEST_URI'])[4]:
                    switch ($method) {
                        case 'GET':
                            $controller = new OneCarController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new OneCarController();
                            $controller->post();
                            break;
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
                    switch ($method) {
                        case 'GET':
                            $controller = new HomeController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new HomeController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/connexion':
                    switch ($method) {
                        case 'GET':
                            $controller = new LoginController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new LoginController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/inscription':
                    switch ($method) {
                        case 'GET':
                            $controller = new RegisterController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new RegisterController();
                            $controller->post();
                            break;
                    }
                    break;
                case '/reservation/' . explode("/", $_SERVER['REQUEST_URI'])[2]:
                    switch ($method) {
                        case 'GET':
                            $controller = new CarsController();
                            $controller->index();
                            break;
                        case 'POST':
                            $controller = new CarsController();
                            $controller->post();
                            break;
                    }
                    break;
                default:
                    http_response_code(404);
                    echo 'Page not found';
                    break;
            }
        }
    }
}
