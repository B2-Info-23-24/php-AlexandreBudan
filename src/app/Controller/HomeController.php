<?php

namespace Controller;

class HomeController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $see = $twig->render('home.twig');

        echo $see;
    }
}
