<?php

namespace Controller;

use Entity\User;
use Model;

class HomeController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $_SESSION['user'] = Model\UserModel::getOneUser(4);

        echo $_SESSION['user']->getAddress()->getId();
        echo $_SESSION['user']->getReservations()[0]->getId();

        $see = $twig->render('home.twig');

        echo $see;
    }
}
