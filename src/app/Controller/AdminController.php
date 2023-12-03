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
use Model\UserModel;

class AdminController
{

    public function index(string $type = "Marques", $err = null, $err2 = null, $err3 = null, $oneCar = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('admin.twig');

        $data = null;
        $brands = null;
        $colors = null;
        $passengers = null;
        $oneUser = null;
        $opinions = null;


        if ($type == 'Marques' || $type == 'Couleurs' || $type == 'Passagers') {
            $loadTemp = $twig->load('/templates/adminSee.twig');
        } elseif ($type == 'Utilisateurs' || $type == 'OneUser') {
            $loadTemp = $twig->load('/templates/adminSee2.twig');
        } elseif ($type == 'opinionFilter' || $type == 'opinionCar' || $type == 'opinion') {
            $brandModel = new BrandModel();
            $brands = $brandModel->getAllBrand();
            $colorModel = new ColorModel();
            $colors = $colorModel->getAllColor();
            $passengerModel = new PassengerModel();
            $passengers = $passengerModel->getAllPassenger();
            $loadTemp = $twig->load('/templates/seeOpinion.twig');
        } elseif ($type == 'newUser') {
            $type = "Ajouter un User";
            $loadTemp = $twig->load('/templates/addUser.twig');
        } elseif ($type == 'Cars' || $type == 'filter') {
            $brandModel = new BrandModel();
            $brands = $brandModel->getAllBrand();
            $colorModel = new ColorModel();
            $colors = $colorModel->getAllColor();
            $passengerModel = new PassengerModel();
            $passengers = $passengerModel->getAllPassenger();
            $loadTemp = $twig->load('/templates/seeAllCar.twig');
        }

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
            case 'Cars':
                $carModel = new CarModel();
                $data = $carModel->getAllCar(true, null);
                break;
            case 'filter':
                $carModel = new CarModel();
                $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers'], "none", true);
                $type = 'Cars';
                break;
            case 'Utilisateurs':
                $userModel = new UserModel();
                $data = $userModel->getAllUser();
                break;
            case 'OneUser':
                $type = 'Utilisateurs';
                $userModel = new UserModel();
                $data = $userModel->getAllUser();
                $oneUser = $userModel->getOneUser($_POST['modifUser']);
                break;
            case 'opinionFilter':
                $carModel = new CarModel();
                $data = $carModel->getCarsByFilter($_POST['search'], $_POST['price'], $_POST['brand'], $_POST['color'], $_POST['passengers'], "none", true);
                $type = 'Opinions';
                break;
            case 'opinion':
                $carModel = new CarModel();
                $data = $carModel->getAllCar(true, null);
                $type = 'Opinions';
                break;
            case 'opinionCar':
                $opinionModel = new OpinionModel();
                $opinions = $opinionModel->getOpinionsByCarId($_POST['seeOpinion']);
                $carModel = new CarModel();
                $data = $carModel->getAllCar(true, null);
                $type = 'Opinions';
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
            'opinions' => $opinions
        ]);

        $see = $loadSee->render(['see' => $seeTemp]);

        if (isset($_POST['allCar'])) {
            $loadTemp = $twig->load('/templates/seeAllCar.twig');
            $brandModel = new BrandModel();
            $brands = $brandModel->getAllBrand();
            $colorModel = new ColorModel();
            $colors = $colorModel->getAllColor();
            $passengerModel = new PassengerModel();
            $passengers = $passengerModel->getAllPassenger();
            $carModel = new CarModel();
            $data = $carModel->getAllCar(true, null);
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => 'Cars',
                'brands' => $brands,
                'colors' => $colors,
                'passengers' => $passengers,
                'error3' => $err3,
                'oneCar' => $oneCar
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seeBrand'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $brandModel = new BrandModel();
            $data = $brandModel->getAllBrand();
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => "Marques",
                'error' => $err,
                'error2' => $err2
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seeColor'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $colorModel = new ColorModel();
            $data = $colorModel->getAllColor();
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => "Couleurs",
                'error' => $err,
                'error2' => $err2
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['seePassenger'])) {
            $loadTemp = $twig->load('/templates/adminSee.twig');
            $passengerModel = new PassengerModel();
            $data = $passengerModel->getAllPassenger();
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => "Passagers",
                'error' => $err,
                'error2' => $err2
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['allUsers'])) {
            $loadTemp = $twig->load('/templates/adminSee2.twig');
            $userModel = new UserModel();
            $data = $userModel->getAllUser();
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => "Utilisateurs"
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['allOpinion'])) {
            $loadTemp = $twig->load('/templates/seeOpinion.twig');
            $brandModel = new BrandModel();
            $brands = $brandModel->getAllBrand();
            $colorModel = new ColorModel();
            $colors = $colorModel->getAllColor();
            $passengerModel = new PassengerModel();
            $passengers = $passengerModel->getAllPassenger();
            $carModel = new CarModel();
            $data = $carModel->getAllCar(true, null);
            $seeTemp = $loadTemp->render([
                'data' => $data,
                'type' => 'Opinions',
                'brands' => $brands,
                'colors' => $colors,
                'passengers' => $passengers
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['addCar'])) {
            $loadTemp = $twig->load('/templates/addCar.twig');
            $brandModel = new BrandModel();
            $brands = $brandModel->getAllBrand();
            $colorModel = new ColorModel();
            $colors = $colorModel->getAllColor();
            $passengerModel = new PassengerModel();
            $passengers = $passengerModel->getAllPassenger();
            $seeTemp = $loadTemp->render([
                'type' => "Ajouter une voiture",
                'brands' => $brands,
                'colors' => $colors,
                'passengers' => $passengers
            ]);
            $see = $loadSee->render(['see' => $seeTemp]);
        } elseif (isset($_POST['addUser'])) {
            $loadTemp = $twig->load('/templates/addUser.twig');
            $seeTemp = $loadTemp->render([
                'type' => "Ajouter un User"
            ]);
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
            $user = new User(0, $_POST['email'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['age'], $_POST['gender'], $address, [], [], $date->format('Y-m-d H:i:s'), false, false, $admin);
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
            // } elseif (isset($_POST['suppResa'])) {
            //     $carModel = new CarModel();
            //     if ($carModel->deleteReservation($_POST['suppResa'])) {
            //         self::index("Reservations");
            //     } else {
            //         self::index("Reservations", null, "error");
            //     }
        } else {
            self::index();
        }
    }
}
