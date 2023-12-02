<?php

namespace Controller;

use Model\CarModel;

class OneCarController
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $requestDec = explode("/", $_SERVER['REQUEST_URI']);
        $id = explode("?", $requestDec[sizeof($requestDec) - 1])[0];

        $carModel = new CarModel();

        $data = $carModel->getOneCar($id);

        $loadSee = $twig->load('oneCar.twig');

        $see = $loadSee->render([
            'data' => $data,
            'user' => $_SESSION['user']
        ]);

        echo $see;
    }
}
