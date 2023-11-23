<?php

namespace Controller;

class RegisterController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $see = $twig->render('register.twig');

        echo $see;
    }
}
