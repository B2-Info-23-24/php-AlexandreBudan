<?php

namespace Controller;

use Model\UserModel;

class ProfilController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $data = [
            'user' => $_SESSION['user']
        ];

        $see = $twig->load('profil.twig');

        echo $see->render($data);
    }
}
