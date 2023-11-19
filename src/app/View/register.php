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
    <link rel="stylesheet" href="/assets/register.css">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>PrendsTaGo - Inscription</title>
</head>

<body>
    <?= $header ?>

    <div class="containerBox bg">
        <h1>Inscription</h1>
        <form action="/" method="post">
            <div class="form-group">
                <label for="firstName">Prénom :</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Nom :</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="phone" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="age">Âge :</label>
                <input type="age" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="gender">Genre :</label>
                <select type="gender" id="gender" name="gender" required>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                    <option value="autre">Autre</option>
                </select>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>

    <?= $footer ?>
</body>

</html>