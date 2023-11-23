<?php

namespace Controller;

class LoginController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $see = $twig->render('login.twig');

        echo $see;
    }
}
