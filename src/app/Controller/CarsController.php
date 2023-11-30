<?php

namespace Controller;

use Model\BrandModel;
use Model\CarModel;
use Model\ColorModel;
use Model\PassengerModel;

class CarsController
{

    public function index($data = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $seeLoad = $twig->load('cars.twig');

        if ($data == null) {
            $carModel = new CarModel();
            $data = $carModel->getAllCar();
        }
        $brandModel = new BrandModel();
        $brands = $brandModel->getAllBrand();
        $colorModel = new ColorModel();
        $colors = $colorModel->getAllColor();
        $passengerModel = new PassengerModel();
        $passengers = $passengerModel->getAllPassenger();

        $see = $seeLoad->render([
            'user' => $_SESSION['user'],
            'data' => $data,
            'brands' => $brands,
            'colors' => $colors,
            'passengers' => $passengers,
            'filters' => $twig->render('/templates/filters.twig')
        ]);

        echo $see;
    }

    public function post()
    {
        if (isset($_POST['launch'])) {
            $carModel = new CarModel();
            $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers']);
            self::index($data);
        } else {
            self::index();
        }
    }
}
