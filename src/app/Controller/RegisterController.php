<?php

namespace Controller;

use ArrayObject;
use DateTime;
use Entity\Address;
use Entity\User;
use Model\UserModel;

class RegisterController
{

    public function index($err = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        if ($err !== null) {
            $loadSee = $twig->load('register.twig');
            $see = $loadSee->render(['error' => $err]);
        } else {
            $see = $twig->render('register.twig');
        }

        echo $see;
    }

    public function post()
    {
        $userModel = new UserModel();
        $address = new Address(0, $_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['country']);
        $date = new DateTime();
        $user = new User(0, $_POST['email'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['age'], $_POST['gender'], $address, [], [], $date->format('Y-m-d H:i:s'), false, false, false);
        if ($userModel->checkRegister($user->getEmail())) {
            $result = $userModel->createUser($user, $address);

            $_SESSION['user'] = $result;
            header('Location: /profil');
        } else {
            self::index("Already Exist");
        }
    }
}
