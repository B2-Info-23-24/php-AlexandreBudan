<?php

// Configuration de Twig avec le répertoire des templates
$loader = new \Twig\Loader\FilesystemLoader('../app/View/templates');
$twig = new \Twig\Environment($loader);

// Rendu des templates Twig
$header = $twig->render('header.twig');
$footer = $twig->render('footer.twig');
$car = $twig->render('carCard.twig');
$filter = $twig->render('filters.twig');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/cars.css">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>PrendsTaGo - Vehicules</title>
</head>

<body>
    <?= $header ?>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div id="texte" class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Vehicules PrendsTaGo</h1>
                <p id="texte" class="lead text-body-secondary">Offrez-vous une expérience inoubliable au volant de nos véhicules de prestige. Découvrez le confort, la puissance et l'élégance à chaque kilomètre parcouru. Réservez dès maintenant et transformez chaque trajet en une aventure mémorable.</p>
            </div>
        </div>
    </section>
    <?= $filter ?>
    <div class="album bg">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?= $car ?>
            </div>
        </div>
    </div>

    <?= $footer ?>
</body>

</html>