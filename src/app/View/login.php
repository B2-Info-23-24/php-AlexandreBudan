<?php

// Configuration de Twig avec le répertoire des templates
$loader = new \Twig\Loader\FilesystemLoader('../app/View/templates');
$twig = new \Twig\Environment($loader);

// Rendu des templates Twig
$header = $twig->render('header.twig');
$footer = $twig->render('footer.twig');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/login.css">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>PrendsTaGo - Connexion</title>
</head>

<body>
    <?= $header ?>

    <div class="bg">
        <div class="login-container">
            <h2>Connexion</h2>
            <form action="/" method="post">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <input type="submit" value="Se connecter">
            </form>
            <p>Vous n'avez pas de compte? <a href="/inscription">S'inscrire</a></p>
        </div>
    </div>

    <?= $footer ?>
</body>

</html>