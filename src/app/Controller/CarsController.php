<?php

namespace Controller;

use Config\DataBase;
use Entity\Favori;
use Model\BrandModel;
use Model\CarModel;
use Model\ColorModel;
use Model\FavoriModel;
use Model\PassengerModel;
use Model\UserModel;

class CarsController
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function index($type = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $seeLoad = $twig->load('cars.twig');

        $carModel = new CarModel();
        $userModel = new UserModel();
        $favoriModel = new FavoriModel();
        $brandModel = new BrandModel();
        $colorModel = new ColorModel();
        $passengerModel = new PassengerModel();

        $user = null;
        $userFavories = null;
        $count = null;
        $data = null;

        $request = explode("?", $_SERVER['REQUEST_URI']);
        if (explode("=", $request[1])[1] != "none") {
            $data = $carModel->getAllCarByLocation(explode("=", $request[1])[1], $_SESSION['reservation']->getBeginning(), $_SESSION['reservation']->getEnding());
        } else {
            $data = $carModel->getAllCar();
            $count = ceil(self::$conn->query("SELECT COUNT(*) AS total FROM Car")->fetchColumn() / 9);
        }

        switch ($type) {
            case 'launch':
                $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers'], explode("=", $request[1])[1], false);
                break;
            case 'pagination':
                $data = $carModel->getAllCar(false, $_POST['pagination']);
                $count = ceil(self::$conn->query("SELECT COUNT(*) AS total FROM Car")->fetchColumn() / 9);
                break;
            case 'newFavori':
                $carId = explode("/", $_POST['starValue'])[1];
                $delAdd = strval(explode("/", $_POST['starValue'])[0]);
                if ($delAdd == "0") {
                    $favoriModel->deleteFavori($_SESSION['user'], $carId);
                } else {
                    $favori = new Favori(0, $_SESSION['user'], $carModel->getOneCar($carId));
                    $favoriModel->createFavori($favori);
                }
                break;
        }

        $brands = $brandModel->getAllBrand();
        $colors = $colorModel->getAllColor();
        $passengers = $passengerModel->getAllPassenger();

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $userFavories = $favoriModel->getAllFavoriOfUser($_SESSION['user']->getId());
        }

        $see = $seeLoad->render([
            'user' => $user,
            'data' => $data,
            'brands' => $brands,
            'colors' => $colors,
            'passengers' => $passengers,
            'request' => $request,
            'count' => $count,
            'userFavories' => $userFavories
        ]);

        echo $see;
    }

    public function post()
    {
        if (isset($_POST['launch'])) {
            self::index("launch");
        } elseif (isset($_POST['pagination'])) {
            self::index("pagination");
        } elseif (isset($_POST['starValue'])) {
            self::index("newFavori");
        } else {
            self::index();
        }
    }
}
