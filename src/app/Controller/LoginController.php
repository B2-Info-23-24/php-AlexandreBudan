<?php

namespace Controller;

use Model\UserModel;

class LoginController
{

    public static function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $see = $twig->render('login.twig');

        echo $see;
    }

    public static function post()
    {
        $userId = UserModel::checkLogin($_POST['email'], $_POST['password']);
        if ($userId !== false) {
            $_SESSION['user'] = UserModel::getOneUser($userId);
            header('Location: /profil');
        } else {
            header('Location: /connexion');
        }
    }
}
