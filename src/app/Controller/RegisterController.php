<?php

namespace Controller;

use DateTime;
use Entity\Address;
use Entity\User;
use Model\UserModel;

class RegisterController
{

    public function index($type = null, $err = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $loadSee = $twig->load('register.twig');

        switch ($type) {
            case 'register':
                $userModel = new UserModel();
                $address = new Address(0, $_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['country']);
                $date = new DateTime();
                $user = new User(0, $_POST['email'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['age'], $_POST['gender'], $address, [], [], [], $date->format('Y-m-d H:i:s'), false, false, false);
                if ($userModel->checkRegister($user->getEmail())) {
                    $_SESSION['user'] = $userModel->createUser($user, $address);
                    header('Location: /profil');
                } else {
                    $err = "error";
                }
                break;
        }

        $see = $loadSee->render(['error' => $err]);

        echo $see;
    }

    public function post()
    {
        self::index("register");
    }
}
