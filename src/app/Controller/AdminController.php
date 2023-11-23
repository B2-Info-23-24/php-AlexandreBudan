<?php

namespace Controller;

class AdminController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('admin.twig');

        $loadTemp = $twig->load('/templates/adminSee.twig');
        $seeTemp = $loadTemp->render(['type' => "Marques"]);

        $see = $loadSee->render(['see' => $seeTemp]);

        if (isset($_POST['allCar'])) {
            $loadTemp = $twig->load('/templates/seeAllCar.twig');
            $seeTemp = $loadTemp->render([
                'type' => "Marques",
                'car' => $twig->render('/templates/carCard.twig'),
                'filters' => $twig->render('/templates/filters.twig')
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seeBrand'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $seeTemp = $loadTemp->render(['type' => "Marques"]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seeColor'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $seeTemp = $loadTemp->render(['type' => "Couleurs"]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seePassenger'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $seeTemp = $loadTemp->render(['type' => "Passagers"]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['allUsers'])) {
            $loadTemp = $twig->load('/templates/adminSee2.twig');
            $seeTemp = $loadTemp->render(['type' => "Utilisateurs"]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['allOpinion'])) {
            $loadTemp = $twig->load('/templates/opinion.twig');
            $seeTemp = $loadTemp->render([
                'type' => "Avis",
                'car' => $twig->render('/templates/carCard.twig')
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['addCar'])) {
            $loadTemp = $twig->load('/templates/addCar.twig');
            $seeTemp = $loadTemp->render(['type' => "Ajouter une voiture"]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['allResa'])) {
            $loadTemp = $twig->load('/templates/reservation.twig');
            $seeTemp = $loadTemp->render([
                'type' => "Reservations",
                'car' => $twig->render('/templates/carCard.twig')
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        }

        echo $see;
    }
}
