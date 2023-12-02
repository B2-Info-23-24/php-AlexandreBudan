<?php

namespace Controller;

use Config\DataBase;
use Entity\Favori;
use Model\BrandModel;
use Model\CarModel;
use Model\ColorModel;
use Model\FavoriModel;
use Model\PassengerModel;

class CarsController
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function index($data = null, $count = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        } else {
            $user = null;
        }
        $carModel = new CarModel();

        $request = explode("?", $_SERVER['REQUEST_URI']);
        if ($data == null) {

            if (explode("=", $request[1])[1] != "none") {
                $data = $carModel->getAllCarByLocation(explode("=", $request[1])[1]);
            } else {
                $data = $carModel->getAllCar();
                $count = ceil(self::$conn->query("SELECT COUNT(*) AS total FROM Car")->fetchColumn() / 9);
            }
        }

        $seeLoad = $twig->load('cars.twig');

        $brandModel = new BrandModel();
        $brands = $brandModel->getAllBrand();
        $colorModel = new ColorModel();
        $colors = $colorModel->getAllColor();
        $passengerModel = new PassengerModel();
        $passengers = $passengerModel->getAllPassenger();

        $see = $seeLoad->render([
            'user' => $user,
            'data' => $data,
            'brands' => $brands,
            'colors' => $colors,
            'passengers' => $passengers,
            'filters' => $twig->render('/templates/filters.twig'),
            'request' => $request,
            'count' => $count
        ]);

        echo $see;
    }

    public function post()
    {
        $request = explode("?", $_SERVER['REQUEST_URI']);
        $carModel = new CarModel();
        if (isset($_POST['launch'])) {
            $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers'], explode("=", $request[1])[1], false);
            self::index($data);
        } elseif (isset($_POST['pagination'])) {
            $data = $carModel->getAllCar(false, $_POST['pagination']);
            self::index($data, ceil(self::$conn->query("SELECT COUNT(*) AS total FROM Car")->fetchColumn() / 9));
        } elseif (isset($_POST['starValue'])) {
            var_dump("test");
            $carId = $_POST['starValue'];
            $favoriModel = new FavoriModel();
            $userFavories = $favoriModel->getAllFavoriOfUser($_SESSION['user']->getId());
            foreach ($userFavories as $userFavories) {
                if ($userFavories->getCar()->getId() == $carId && $userFavories->getUser()->getId() == $_SESSION['user']->getId()) {
                    $favoriModel->deleteFavori($_SESSION['user']->getId(), $carId);
                    return;
                }
            }
            $favori = new Favori(0, $_SESSION['user'], $carModel->getOneCar($carId));
            $favoriModel->createFavori($favori);
            return;
        } else {
            self::index();
        }
    }
}
