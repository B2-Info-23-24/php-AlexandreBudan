<?php

namespace Controller;

use Entity\Reservation;
use PDO;

class HomeController
{

    public function index($err1 = null, $err2 = null)
    {

        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('home.twig');

        if (isset($_SESSION['user'])) {
            $see = $loadSee->render([
                'user' => $_SESSION['user'],
                'error1' => $err1,
                'error2' => $err2
            ]);
        } else {
            $see = $loadSee->render([
                'user' => null,
                'error1' => $err1,
                'error2' => $err2
            ]);
        }

        echo $see;
    }

    public function post()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        } else {
            $user = null;
        }

        $beginning = $_POST["beginning"];
        $ending = $_POST["ending"];

        // Vérification côté serveur pour s'assurer que la date de début est postérieure à la date actuelle + 1 jour
        $minDate = date('Y-m-d\TH:i', strtotime('+1 day'));
        if ($beginning < $minDate) {
            self::index("error");
        } else {
            if ($ending < $beginning) {
                self::index(null, "error");
            } else {
                $random_base64 = strtr(base64_encode(random_bytes(18)), '/+', '_-');

                $resa = new Reservation(0, null, $user, null, $random_base64, null, null, $_POST['beginning'], $_POST['ending'], 0, null, null, null);
                $_SESSION['reservation'] = $resa;
                $location = $_POST['location'] . "x" . $_POST['param'];

                header('Location: /reservation/' . $resa->getHash() . '?location=' . $location);
            }
        }
    }
}
