<?php

namespace Controller;

use Model\UserModel;

class ProfilController
{

    public static function index($err = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        if ($err != null) {
            $data = [
                'user' => $_SESSION['user'],
                'error' => "Mauvais Mot de Passe"
            ];
        } else {
            $data = [
                'user' => $_SESSION['user']
            ];
        }

        $see = $twig->load('profil.twig');

        echo $see->render($data);
    }

    public static function post()
    {
        $user = $_SESSION['user'];
        if (isset($_POST['NP'])) {
            UserModel::updateUser($user['id'], 1, [$_POST['firstName'], $_POST['lastName']]);
            header('Location: /profil');
        } elseif (isset($_POST['mdp'])) {
            if (UserModel::updateUser($user['id'], 2, [$_POST['currentPass'], $_POST['newPass']]) !== null) {
                self::index(true);
            } else {
                self::index();
            }
        } elseif (isset($_POST['add'])) {
            UserModel::updateUser($user['address']->getId(), 3, [$_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['country']]);
            header('Location: /profil');
        } else {
            $_SESSION['user'] = null;
            header('Location: /');
        }
    }
}
