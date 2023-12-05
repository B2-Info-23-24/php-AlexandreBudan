<?php

namespace Controller;

use DateTime;
use Entity\Address;
use Entity\Car;
use Entity\User;
use Model\BrandModel;
use Model\CarModel;
use Model\ColorModel;
use Model\OpinionModel;
use Model\PassengerModel;
use Model\ReservationModel;
use Model\UserModel;

class AdminController
{

    public function index(string $type = "Marques", $err = null, $err2 = null, $err3 = null, $oneCar = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('admin.twig');

        $brandModel = new BrandModel();
        $colorModel = new ColorModel();
        $passengerModel = new PassengerModel();
        $carModel = new CarModel();
        $userModel = new UserModel();
        $opinionModel = new OpinionModel();
        $reservationModel = new ReservationModel();

        $data = $brands = $colors = $passengers = $oneUser = $opinions = $reservations = null;

        switch ($type) {
            case 'Marques':
                $loadTemp = $twig->load('/templates/adminSee.twig');
                $data = $brandModel->getAllBrand();
                break;
            case 'Couleurs':
                $loadTemp = $twig->load('/templates/adminSee.twig');
                $data = $colorModel->getAllColor();
                break;
            case 'Passagers':
                $loadTemp = $twig->load('/templates/adminSee.twig');
                $data = $passengerModel->getAllPassenger();
                break;
            case 'Cars':
                $loadTemp = $twig->load('/templates/seeAllCar.twig');
                $data = $carModel->getAllCar(true, null);
                break;
            case 'filter':
                $loadTemp = $twig->load('/templates/seeAllCar.twig');
                $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers'], "none", true);
                break;
            case 'Utilisateurs':
                $loadTemp = $twig->load('/templates/adminSee2.twig');
                $data = $userModel->getAllUser();
                break;
            case 'OneUser':
                $loadTemp = $twig->load('/templates/adminSee2.twig');
                $data = $userModel->getAllUser();
                $oneUser = $userModel->getOneUser($_POST['modifUser']);
                break;
            case 'opinionFilter':
                $loadTemp = $twig->load('/templates/seeOpinion.twig');
                $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers'], "none", true);
                break;
            case 'opinion':
                $loadTemp = $twig->load('/templates/seeOpinion.twig');
                $data = $carModel->getAllCar(true, null);
                break;
            case 'opinionCar':
                $loadTemp = $twig->load('/templates/seeOpinion.twig');
                $opinions = $opinionModel->getOpinionsByCarId($_POST['seeOpinion']);
                $data = $carModel->getAllCar(true, null);
                break;
            case 'reservationFilter':
                $loadTemp = $twig->load('/templates/seeReservation.twig');
                $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers'], "none", true);
                break;
            case 'reservation':
                $loadTemp = $twig->load('/templates/seeReservation.twig');
                $data = $carModel->getAllCar(true, null);
                break;
            case 'reservationCar':
                $loadTemp = $twig->load('/templates/seeReservation.twig');
                $reservations = $reservationModel->getReservationsByCarId($_POST['seeReservation']);
                $data = $carModel->getAllCar(true, null);
                break;
            case 'newUser':
                $loadTemp = $twig->load('/templates/addUser.twig');
                break;
            case 'newCar':
                $loadTemp = $twig->load('/templates/addCar.twig');
                break;
        }

        switch ($type) {
            case 'Cars' || 'filter' || 'reservationFilter' || 'reservation' || 'reservationCar' || 'opinionFilter' || 'opinion' || 'opinionCar' || 'newCar':
                $brands = $brandModel->getAllBrand();
                $colors = $colorModel->getAllColor();
                $passengers = $passengerModel->getAllPassenger();
                break;
        }

        $seeTemp = $loadTemp->render([
            'data' => $data,
            'type' => $type,
            'brands' => $brands,
            'colors' => $colors,
            'passengers' => $passengers,
            'error' => $err,
            'error2' => $err2,
            'error3' => $err3,
            'oneCar' => $oneCar,
            'oneUser' => $oneUser,
            'opinions' => $opinions,
            'reservations' => $reservations
        ]);

        $see = $loadSee->render(['see' => $seeTemp]);

        echo $see;
    }

    public function post()
    {
        if (isset($_POST['allCar'])) {
            self::index("Cars");
        } elseif (isset($_POST['seeBrand'])) {
            self::index("Marques");
        } elseif (isset($_POST['seeColor'])) {
            self::index("Couleurs");
        } elseif (isset($_POST['seePassenger'])) {
            self::index("Passagers");
        } elseif (isset($_POST['allUsers'])) {
            self::index("Utilisateurs");
        } elseif (isset($_POST['allOpinion'])) {
            self::index("opinion");
        } elseif (isset($_POST['addCar'])) {
            self::index("newCar");
        } elseif (isset($_POST['addUser'])) {
            self::index("newUser");
        } elseif (isset($_POST['allResa'])) {
            self::index("reservation");
        } elseif (isset($_POST['supp'])) {
            $array = explode("-", $_POST['supp']);
            switch ($array[0]) {
                case 'brand':
                    $brandModel = new BrandModel();
                    if ($brandModel->deleteBrand($array[1])) {
                        self::index("Marques");
                    } else {
                        self::index("Marques", "error");
                    }
                    break;
                case 'color':
                    $colorModel = new ColorModel();
                    if ($colorModel->deleteColor($array[1])) {
                        self::index("Couleurs");
                    } else {
                        self::index("Couleurs", "error");
                    }
                    break;
                case 'passenger':
                    $passengerModel = new PassengerModel();
                    if ($passengerModel->deletePassenger($array[1])) {
                        self::index("Passagers");
                    } else {
                        self::index("Passagers", "error");
                    }
                    break;
            }
        } elseif (isset($_POST['add'])) {
            switch ($_POST['add']) {
                case 'brand':
                    $brandModel = new BrandModel();
                    if ($brandModel->checkCreate($_POST['val'])) {
                        $brandModel->createBrand($_POST['val']);
                        self::index("Marques");
                    } else {
                        self::index("Marques", null, "error");
                    }
                    break;
                case 'color':
                    $colorModel = new ColorModel();
                    if ($colorModel->checkCreate($_POST['val'])) {
                        $colorModel->createColor($_POST['val']);
                        self::index("Couleurs");
                    } else {
                        self::index("Couleurs", null, "error");
                    }
                    break;
                case 'passenger':
                    $passengerModel = new PassengerModel();
                    if ($passengerModel->checkCreate($_POST['val'])) {
                        $passengerModel->createPassenger($_POST['val']);
                        self::index("Passagers");
                    } else {
                        self::index("Passagers", null, "error");
                    }
                    break;
            }
        } elseif (isset($_POST['removeCar'])) {
            $carModel = new CarModel();
            if ($carModel->deleteCar($_POST['removeCar'])) {
                self::index("Cars");
            } else {
                self::index("Cars", null, null, "error");
            }
            self::index("Cars");
        } elseif (isset($_POST['saveButton'])) {
            $carModel = new CarModel();
            $uploadsDirectory = '../public/img/';
            $uploadedFile = $_FILES['file-input'];
            $destinationPath = $uploadsDirectory . $uploadedFile['name'];

            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }

            if (move_uploaded_file($uploadedFile['tmp_name'], $destinationPath)) {
                $brandModel = new BrandModel();
                $colorModel = new ColorModel();
                $passengerModel = new PassengerModel();
                $car = new Car(0, $_POST['name'], $brandModel->getOneBrand($_POST['brand']), $colorModel->getOneColor($_POST['color']), $passengerModel->getOnePassenger($_POST['passenger']), '/img/' . $uploadedFile['name'], $_POST['price'], $_POST['transmition'], $_POST['type'], $_POST['minAge'], $_POST['nbDoor'], $_POST['location']);
                $carModel->createCar($car, $_POST['status']);
                self::index("Cars");
            } else {
                echo 'Erreur lors de l\'enregistrement de l\'image.';
            }
        } elseif (isset($_POST['launch'])) {
            self::index("filter");
        } elseif (isset($_POST['opinionLaunch'])) {
            self::index("opinionFilter");
        } elseif (isset($_POST['reservationLaunch'])) {
            self::index("reservationFilter");
        } elseif (isset($_POST['modifCar'])) {
            $carModel = new CarModel();
            $oneCar = $carModel->getOneCar($_POST['modifCar']);
            self::index("Cars", null, null, null, $oneCar);
        } elseif (isset($_POST['saveCar'])) {
            $carModel = new CarModel();
            $try = true;
            $img = $_POST['inputPicture'];
            if (isset($_FILES['input-file'])) {
                $uploadsDirectory = '../public/img/';
                $uploadedFile = $_FILES['file-input'];
                $destinationPath = $uploadsDirectory . $uploadedFile['name'];

                if (file_exists($destinationPath)) {
                    unlink($destinationPath);
                }

                $img = '/img/' . $uploadedFile['name'];

                $try = move_uploaded_file($uploadedFile['tmp_name'], $destinationPath);
            }

            if ($try || !isset($_FILES['input-file'])) {
                $brandModel = new BrandModel();
                $colorModel = new ColorModel();
                $passengerModel = new PassengerModel();
                $car = new Car(0, $_POST['name'], $brandModel->getOneBrand($_POST['brand']), $colorModel->getOneColor($_POST['color']), $passengerModel->getOnePassenger($_POST['passenger']), $img, $_POST['price'], $_POST['transmition'], $_POST['type'], $_POST['minAge'], $_POST['nbDoor'], $_POST['location']);
                $carModel->updateCar($_POST['id'], $car, $_POST['status']);
                self::index("Cars");
            } else {
                echo 'Erreur lors de l\'enregistrement de l\'image.';
            }
        } elseif (isset($_POST['suppUser'])) {
            $userModel = new UserModel();
            $userModel->deleteUser($_POST['suppUser']);
            self::index("Utilisateurs");
        } elseif (isset($_POST['unSuppUser'])) {
            $userModel = new UserModel();
            $userModel->unDeleteUser($_POST['unSuppUser']);
            self::index("Utilisateurs");
        } elseif (isset($_POST['modifUser'])) {
            self::index("OneUser");
        } elseif (isset($_POST['NP'])) {
            $userModel = new UserModel();
            $userModel->updateUser(intval($_POST['NP']), 1, [$_POST['firstName'], $_POST['lastName']]);
            self::index("Utilisateurs");
        } elseif (isset($_POST['newUser'])) {
            $userModel = new UserModel();
            $address = new Address(0, $_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['country']);
            $date = new DateTime();
            $admin = false;
            if ($_POST['admin'] == "true") {
                $admin = true;
            }
            $user = new User(0, $_POST['email'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['age'], $_POST['gender'], $address, [], [], [], $date->format('Y-m-d H:i:s'), false, false, $admin);
            if ($userModel->checkRegister($user->getEmail())) {
                $userModel->createUser($user, $address);
                self::index("Utilisateurs");
            } else {
                self::index("newUser", "error");
            }
        } elseif (isset($_POST['seeOpinion'])) {
            self::index("opinionCar");
        } elseif (isset($_POST['suppOpinion'])) {
            $opinionModel = new OpinionModel();
            $opinionModel->deleteOpinion($_POST['suppOpinion']);
            self::index("opinion");
        } elseif (isset($_POST['seeReservation'])) {
            self::index("reservationCar");
        } elseif (isset($_POST['suppReservation'])) {
            $reservationModel = new ReservationModel();
            $result = explode("-", $_POST['suppReservation']);
            $reservationModel->deleteReservation($result[0], $result[1]);
            self::index("reservation");
        } else {
            self::index();
        }
    }
}
