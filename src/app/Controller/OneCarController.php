<?php

namespace Controller;

class OneCarController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $see = $twig->render('cars.twig');

        echo $see;
    }
}