<?php

namespace Controller;

use Model\UserModel;

class LoginController
{

    public function index($type = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $userModel = new UserModel();

        switch ($type) {
            case 'login':
                $userId = $userModel->checkLogin($_POST['email'], $_POST['password']);
                if ($userId !== false) {
                    $_SESSION['user'] = $userModel->getOneUser($userId);
                    header('Location: /profil');
                } else {
                    header('Location: /connexion');
                }
                break;
        }

        $see = $twig->render('login.twig');

        echo $see;
    }

    public function post()
    {
        self::index("login");
    }
}
