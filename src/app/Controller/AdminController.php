<?php

namespace Controller;

use Model\BrandModel;
use Model\ColorModel;
use Model\PassengerModel;

class AdminController
{

    public function index(string $type = "Marques", $err = null, $err2 = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('admin.twig');

        $loadTemp = $twig->load('/templates/adminSee.twig');

        $data = null;

        switch ($type) {
            case 'Marques':
                $brandModel = new BrandModel();
                $data = $brandModel->getAllBrand();
                break;
            case 'Couleurs':
                $colorModel = new ColorModel();
                $data = $colorModel->getAllColor();
                break;
            case 'Passagers':
                $passengerModel = new PassengerModel();
                $data = $passengerModel->getAllPassenger();
                break;
        }

        if ($err != null) {
            $seeTemp = $loadTemp->render(['data' => $data, 'type' => $type, 'error' => "err"]);
        } elseif ($err2 != null) {
            $seeTemp = $loadTemp->render(['data' => $data, 'type' => $type, 'error2' => "err2"]);
        } else {
            $seeTemp = $loadTemp->render(['data' => $data, 'type' => "Marques"]);
        }

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
            $brandModel = new BrandModel();
            $data = $brandModel->getAllBrand();
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => "Marques"
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seeColor'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $colorModel = new ColorModel();
            $data = $colorModel->getAllColor();
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => "Couleurs"
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seePassenger'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $passengerModel = new PassengerModel();
            $data = $passengerModel->getAllPassenger();
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => "Passagers"
            ]);
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

    public function post()
    {
        if (isset($_POST['supp'])) {
            $array = explode("-", $_POST['supp']);
            switch ($array[0]) {
                case 'brand':
                    $brandModel = new BrandModel();
                    if ($brandModel->deleteBrand($array[1]) != false) {
                        self::index();
                    } else {
                        self::index("Marques", "error");
                    }
                    break;
                case 'color':
                    $colorModel = new ColorModel();
                    if ($colorModel->deleteColor($array[1]) != false) {
                        self::index();
                    } else {
                        self::index("Couleurs", "error");
                    }
                    break;
                case 'passenger':
                    $passengerModel = new PassengerModel();
                    if ($passengerModel->deletePassenger($array[1]) != false) {
                        self::index();
                    } else {
                        self::index("Passagers", "error");
                    }
                    break;
            }
        } elseif (isset($_POST['add'])) {
            var_dump($_POST['add']);
            $values = explode("-", $_POST['add']);
            switch ($values[0]) {
                case 'brand':
                    $brandModel = new BrandModel();
                    if ($brandModel->createBrand($values[1]) != false) {
                        self::index("Marques");
                    } else {
                        self::index("Marques", null, "error");
                    }
                    break;
                case 'color':
                    $colorModel = new ColorModel();
                    if ($colorModel->createColor($values[1]) != false) {
                        self::index("Couleurs");
                    } else {
                        self::index("Couleurs", null, "error");
                    }
                    break;
                case 'passenger':
                    $passengerModel = new PassengerModel();
                    if ($passengerModel->createPassenger($values[1]) != false) {
                        self::index("Passagers");
                    } else {
                        self::index("Passagers", null, "error");
                    }
                    break;
            }
        } else {
            self::index();
        }
    }
}
