<?php

// Configuration de Twig avec le répertoire des templates
$loader = new \Twig\Loader\FilesystemLoader('../app/View/templates');
$twig = new \Twig\Environment($loader);

// Rendu des templates Twig
$header = $twig->render('header.twig');
$footer = $twig->render('footer.twig');

$redirectUrl = "/vehicule";

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
    <div id="container-filter">
        <div class="filter-container">
            <div class="filters">
                <label id="texte" , type="price">Prix :</label>
                <select id="price" name="price">
                    <option value="0">-</option>
                    <option value="50">0€ - 50€</option>
                    <option value="100">50€ - 100€</option>
                    <option value="150">100€ - 150€</option>
                </select>

                <label id="texte" for="brand">Marque :</label>
                <select id="brand" name="brand">
                    <option value="0">-</option>
                    <option value="audi">Audi</option>
                    <option value="bmw">BMW</option>
                    <option value="mercedes">Mercedes</option>
                </select>

                <label id="texte" for="color">Couleur :</label>
                <select id="color" name="color">
                    <option value="0">-</option>
                    <option value="rouger">rouge</option>
                    <option value="bleu">bleu</option>
                    <option value="vert">vert</option>
                </select>

                <label id="texte" for="passengers">Nombre de passagers :</label>
                <select id="passengers" name="passengers">
                    <option value="0">-</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="7">7</option>
                    <option value="9">9</option>
                </select>
            </div>
        </div>
    </div>
    <div class="album bg">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                    <a href="<?= $redirectUrl ?>">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="https://www.automobile-magazine.fr/asset/cms/198854/config/146547/p90462506-highres.jpg">
                            </img>
                            <div class="card-body">
                                <h5>Caractéristiques</h5>
                                <p class="card-text">- Nombres de portes : 5</p>
                                <p class="card-text">- Age minimum : 21</p>
                                <p class="card-text">
                                <h6>- A partir de 50€ / jour</h6>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">BMW</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Noir</button>
                                    </div>
                                    <small class="text-body-secondary">Manual - type</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= $redirectUrl ?>">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="https://www.challenges.fr/assets/img/2023/06/14/cover-r4x3w1200-6489c67138b7f-mercedes-benz-glc-front-view.jpg">
                            </img>
                            <div class="card-body">
                                <h5>Caractéristiques</h5>
                                <p class="card-text">- Nombres de portes : 5</p>
                                <p class="card-text">- Age minimum : 21</p>
                                <p class="card-text">
                                <h6>- A partir de 50€ / jour</h6>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Mercedes</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rouge</button>
                                    </div>
                                    <small class="text-body-secondary">Automatic - type</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?= $footer ?>
</body>

</html>