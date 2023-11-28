<?php

namespace Controller;

use Model\UserModel;

class LoginController
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $see = $twig->render('login.twig');

        echo $see;
    }

    public function post()
    {
        $userModel = new UserModel();
        $userId = $userModel->checkLogin($_POST['email'], $_POST['password']);
        if ($userId !== false) {
            $user = $userModel->getOneUser($userId);
            $_SESSION['user'] = $user;
            header('Location: /profil');
        } else {
            header('Location: /connexion');
        }
    }
}
