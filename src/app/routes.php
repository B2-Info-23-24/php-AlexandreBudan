<?php

namespace App;

use Controller;

class Routeur
{
    public static function routage()
    {
        $request = $_SERVER['REQUEST_URI'];

        // if (isset($_SESSION['user']) && $_SESSION['user'] instanceof User) { // Set une session du User
        switch ($request) {
            case '/':
                require_once("../app/Controller/HomeController.php");
                Controller\HomeController::index();
                break;
            case '/connexion':
                require_once("../app/Controller/LoginController.php");
                Controller\LoginController::index();
                break;
            case '/inscription':
                require_once("../app/Controller/RegisterController.php");
                Controller\RegisterController::index();
                break;
            case '/vehicules':
                require_once("../app/Controller/CarsController.php");
                Controller\CarsController::index();
                break;
            case '/profil':
                require_once("../app/Controller/ProfilController.php");
                Controller\ProfilController::index();
                break;
            case '/vehicule':
                require_once("../app/Controller/OneCarController.php");
                Controller\OneCarController::index();
                break;
            case '/admin':
                // if ($_SESSION['user']->isAdmin) {
                require_once("../app/Controller/AdminController.php");
                Controller\AdminController::index();
                // } else {
                //     http_response_code(404);
                //     echo 'Page not found';
                // }
                break;
            default:
                http_response_code(404);
                echo 'Page not found';
                break;
        }
        // } else {
        //     switch ($request) {
        //         case '/':
        //             require_once('../app/View/home.php');
        //             break;
        //         case '/connexion':
        //             require_once('../app/View/login.php');
        //             break;
        //         case '/inscription':
        //             require_once('../app/View/register.php');
        //             break;
        //         case '/vehicules':
        //             require_once('../app/View/cars.php');
        //             break;
        //         default:
        //             http_response_code(404);
        //             echo 'Page not found';
        //             break;
        //     }
        // }
    }
}
