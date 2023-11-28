<?php

namespace Controller;

use ArrayObject;
use Entity\Address;
use Entity\User;
use Model\UserModel;

class RegisterController
{

    public static function index($err = null)
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

    public static function post()
    {
        $address = new Address(0, $_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['country']);
        $user = new User(0, $_POST['email'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['phone'], $_POST['age'], $_POST['gender'], $address, new ArrayObject(), new ArrayObject(), false, false, false);
        if (UserModel::checkRegister($user->getEmail())) {
            $result = UserModel::createUser($user, $address);

            $_SESSION['user'] = $result;
            header('Location: /profil');
        } else {
            self::index("Already Exist");
        }
    }
}
