<?php

$request = $_SERVER['REQUEST_URI'];

// if (isset($_SESSION['user']) && $_SESSION['user'] instanceof User) { // Set une session du User
switch ($request) {
    case '/':
        require_once('../app/View/home.php');
        break;
    case '/connexion':
        require_once('../app/View/login.php');
        break;
    case '/inscription':
        require_once('../app/View/register.php');
        break;
    case '/vehicules':
        require_once('../app/View/cars.php');
        break;
    case '/profil':
        require_once('../app/View/profil.php');
        break;
    case '/vehicule/{$id}':
        require_once('../app/View/oneCar.php');
        break;
    case '/admin':
        if ($_SESSION['user']->isAdmin) {
            require_once('../app/View/admin.php');
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
