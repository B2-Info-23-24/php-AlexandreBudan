<?php

namespace Controller;

use Entity\Reservation;

class HomeController
{

    public function index($type = null, $err1 = null, $err2 = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('home.twig');

        $user = null;

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }

        switch ($type) {
            case 'home':
                $beginning = $_POST["beginning"];
                $ending = $_POST["ending"];

                $minDate = date('Y-m-d\TH:i', strtotime('+1 day'));
                if ($beginning < $minDate) {
                    $err1 = "error";
                } else {
                    if ($ending < $beginning) {
                        $err2 = "error";
                    } else {
                        $random_base64 = strtr(base64_encode(random_bytes(18)), '/+', '_-');

                        $_SESSION['reservation'] = new Reservation(0, null, $user, null, $random_base64, null, null, $_POST['beginning'], $_POST['ending'], 0, null, null, null);
                        $location = $_POST['location'] . "x" . $_POST['param'];

                        header('Location: /reservation/' . $_SESSION['reservation']->getHash() . '?location=' . $location);
                    }
                }
                break;
        }

        $see = $loadSee->render([
            'user' => $user,
            'error1' => $err1,
            'error2' => $err2
        ]);

        echo $see;
    }

    public function post()
    {
        self::index("home");
    }
}
