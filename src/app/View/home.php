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
    <link rel="stylesheet" href="/assets/home.css">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>PrendsTaGo - Home</title>
</head>

<body>
    <?= $header ?>

    <div class="bg">
        <div class="reservation-form">
            <h2>Réserver une voiture</h2>
            <form action="/vehicules" method="post">
                <div class="form-group">
                    <label for="start-date">Date de début :</label>
                    <input type="datetime-local" id="start-date" name="start-date" required>
                </div>
                <div class="form-group">
                    <label for="end-date">Date de fin :</label>
                    <input type="datetime-local" id="end-date" name="end-date" required>
                </div>
                <div class="form-group">
                    <label for="location">Lieu :</label>
                    <input type="text" id="location" name="location" placeholder="Entrez votre lieu de réservation" required>
                </div>
                <input type="submit" value="Réserver">
            </form>
        </div>
    </div>

    <?= $footer ?>
</body>

</html>