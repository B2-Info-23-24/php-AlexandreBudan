<?php

namespace Controller;

use Entity\Opinion;
use Model\FavoriModel;
use Model\OpinionModel;
use Model\ReservationModel;
use Model\UserModel;

class ProfilController
{

    public function index($type = null, $err = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('profil.twig');

        $userModel = new UserModel();
        $favoriModel = new FavoriModel();
        $reservationModel = new ReservationModel();
        $opinionModel = new OpinionModel();

        $reservation = null;

        $_SESSION['opinion'] = null;
        $_SESSION['user'] = $userModel->getOneUser($_SESSION['user']->getId());

        switch ($type) {
            case 'updateUser':
                $userModel->updateUser($_SESSION['user']->getId(), 1, [$_POST['firstName'], $_POST['lastName']]);
                $_SESSION['user'] = $userModel->getOneUser($_SESSION['user']->getId());
                break;
            case 'updateMdp':
                if ($userModel->updateUser($_SESSION['user']->getId(), 2, [$_POST['currentPass'], $_POST['newPass']]) != null) {
                    $err = "error";
                } else {
                    $_SESSION['user'] = $userModel->getOneUser($_SESSION['user']->getId());
                }
                break;
            case 'addAddress':
                $userModel->updateUser($_SESSION['user']->getAddress()->getId(), 3, [$_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['country']]);
                $_SESSION['user'] = $userModel->getOneUser($_SESSION['user']->getId());
                break;
            case 'deleteFavori':
                $carId = $_POST['starValue'];
                $favoriModel->deleteFavori($_SESSION['user'], $carId);
                $_SESSION['user'] = $userModel->getOneUser($_SESSION['user']->getId());
                break;
            case 'showResa':
                $reservationId = $_POST['showResa'];
                $reservation = $reservationModel->getOneReservation($reservationId);
                break;
            case 'deleteResa':
                $reservationId = explode("-", $_POST['deleteResa'])[0];
                $carId = explode("-", $_POST['deleteResa'])[1];
                $reservationModel->deleteReservation($reservationId, $carId);
                $_SESSION['user'] = $userModel->getOneUser($_SESSION['user']->getId());
                break;
            case 'createOpinion':
                $_SESSION['opinion'] = new Opinion(0, explode("-", $_POST['createOpinion'])[1], $_SESSION['user'], explode("-", $_POST['createOpinion'])[0], null, null);
                break;
            case 'create':
                $_SESSION['opinion']->setCommentary($_POST['comment']);
                $_SESSION['opinion']->setRank($_POST['ranking']);
                $opinionModel->createOpinion($_SESSION['opinion']);
                break;
            case 'deconnexion':
                $_SESSION['user'] = null;
                header('Location: /');
                break;
        }

        $see = $loadSee->render([
            'user' => $_SESSION['user'],
            'error' => $err,
            'reservation' => $reservation,
            'opinion' => $_SESSION['opinion']
        ]);

        echo $see;
    }

    public function post()
    {
        if (isset($_POST['NP'])) {
            self::index("updateUser");
        } elseif (isset($_POST['mdp'])) {
            self::index("updateMdp");
        } elseif (isset($_POST['add'])) {
            self::index("addAddress");
        } elseif (isset($_POST['starValue'])) {
            self::index("deleteFavori");
        } elseif (isset($_POST['showResa'])) {
            self::index("showResa");
        } elseif (isset($_POST['deleteResa'])) {
            self::index("deleteResa");
        } elseif (isset($_POST['createOpinion'])) {
            self::index("createOpinion");
        } elseif (isset($_POST['create'])) {
            self::index("create");
        } else {
            self::index("deconnexion");
        }
    }
}
