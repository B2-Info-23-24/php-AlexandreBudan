<?php

namespace Controller;

class ProfilController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $see = $twig->render('profil.twig');

        echo $see;
    }
}
