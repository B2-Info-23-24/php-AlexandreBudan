<?php

namespace Controller;

use Model\FavoriModel;
use Model\ReservationModel;
use Model\UserModel;

class ProfilController
{

    public function index($err = null, $reservation = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('profil.twig');

        $userModel = new UserModel();
        $_SESSION['user'] = $userModel->getOneUser($_SESSION['user']->getId());

        if ($err != null) {
            $see = $loadSee->render([
                'user' => $_SESSION['user'],
                'error' => "Mauvais Mot de Passe",
                'reservation' => $reservation
            ]);
        } else {
            $see = $loadSee->render([
                'user' => $_SESSION['user'],
                'reservation' => $reservation
            ]);
        }

        echo $see;
    }

    public function post()
    {
        $userModel = new UserModel();
        $user = $_SESSION['user'];
        $userId = $user->getId() ?? $user['id'];
        if (isset($_POST['NP'])) {
            $userModel->updateUser($userId, 1, [$_POST['firstName'], $_POST['lastName']]);
            header('Location: /profil');
        } elseif (isset($_POST['mdp'])) {
            if ($userModel->updateUser($userId, 2, [$_POST['currentPass'], $_POST['newPass']]) !== null) {
                self::index(true);
            } else {
                self::index();
            }
        } elseif (isset($_POST['add'])) {
            $userId = $user->getAddress()->getId() ?? $user['address_id'];
            $userModel->updateUser($userId, 3, [$_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['country']]);
            header('Location: /profil');
        } elseif (isset($_POST['starValue'])) {
            $carId = $_POST['starValue'];
            $favoriModel = new FavoriModel();
            $favoriModel->deleteFavori($_SESSION['user'], $carId);
            self::index();
        } elseif (isset($_POST['showResa'])) {
            $reservationId = $_POST['showResa'];
            $reservationModel = new ReservationModel();
            $reservation = $reservationModel->getOneReservation($reservationId);
            self::index(null, $reservation);
        } elseif (isset($_POST['deleteResa'])) {
            $reservationId = $_POST['deleteResa'];
            $reservationModel = new ReservationModel();
            $reservationModel->deleteReservation($reservationId);
            self::index();
        } else {
            $_SESSION['user'] = null;
            header('Location: /');
        }
    }
}
