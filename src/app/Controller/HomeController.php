<?php

namespace Controller;

class HomeController
{

    public function index()
    {

        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        if (isset($_SESSION['user'])) {
            $data = [
                'user' => $_SESSION['user']
            ];

            $loadSee = $twig->load('home.twig');
            $see = $loadSee->render($data);
        } else {
            $see = $twig->render('home.twig');
        }

        echo $see;
    }
}
