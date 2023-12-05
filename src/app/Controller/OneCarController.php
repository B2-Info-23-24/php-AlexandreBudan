<?php

namespace Controller;

use DateTime;
use Entity\Pilote;
use Model\CarModel;
use Model\ReservationModel;

class OneCarController
{

    public function index($type = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('oneCar.twig');

        $carModel = new CarModel();

        $requestDec = explode("/", $_SERVER['REQUEST_URI']);
        $id = explode("?", $requestDec[sizeof($requestDec) - 1])[0];
        $data = $carModel->getOneCar($id);
        $_SESSION['reservation']->setCar($data);

        switch ($type) {
            case 'newReservation':
                $pilote = new Pilote(0, $_SESSION['reservation']->getId(), $_POST['lname'], $_POST['fname'], $_POST['age'], $_POST['email'], $_POST['phone']);

                $_SESSION['reservation']->setPilote($pilote);

                $dateObj1 = new DateTime($_SESSION['reservation']->getBeginning());
                $dateObj2 = new DateTime($_SESSION['reservation']->getEnding());

                $interval = $dateObj1->diff($dateObj2);
                $diffInDays = $interval->format("%a");

                $_SESSION['reservation']->setPrice($_SESSION['reservation']->getCar()->getPrice() * $diffInDays);

                $_SESSION['reservation']->setFinish(false);

                if ($_POST['options'] == "0") {
                    $_SESSION['reservation']->setProtection(false);
                } else {
                    $_SESSION['reservation']->setProtection(true);
                    $_SESSION['reservation']->setAddFees(floatval($_POST['options']));
                    $_SESSION['reservation']->setPrice($_SESSION['reservation']->getPrice() + floatval($_POST['options']));
                }
                break;
            case 'createReservation':
                $reservationModel = new ReservationModel();
                $reservationModel->createReservation($_SESSION['reservation']);
                header('Location: /profil');
                break;
        }

        $see = $loadSee->render([
            'data' => $data,
            'user' => $_SESSION['user'],
            'reservation' => $_SESSION['reservation']
        ]);

        echo $see;
    }

    public function post()
    {
        if (isset($_POST['newReservation'])) {
            self::index("newReservation");
        } else {
            self::index("createReservation");
        }
    }
}
