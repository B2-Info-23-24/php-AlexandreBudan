<?php

namespace Controller;

class CarsController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $seeLoad = $twig->load('cars.twig');

        $see = $seeLoad->render(['cars' => $twig->render('/templates/carCard.twig'), 'filters' => $twig->render('/templates/filters.twig')]);

        echo $see;
    }
}
