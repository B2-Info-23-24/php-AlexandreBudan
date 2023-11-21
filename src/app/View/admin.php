<?php

// Configuration de Twig avec le répertoire des templates
$loader = new \Twig\Loader\FilesystemLoader('../app/View/templates');
$twig = new \Twig\Environment($loader);

// Rendu des templates Twig
$header = $twig->render('header.twig');
$footer = $twig->render('footer.twig');


$loadSee = $twig->load('adminSee.twig');
$see = $loadSee->render(['type' => "Marques"]);

if (isset($_POST['allCar'])) {
    $loadSee = $twig->load('seeAllCar.twig');
    $see = $loadSee->render(['type' => "Marques", 'car' => $twig->render('carCard.twig'), 'filter' => $twig->render('filters.twig')]);
} elseif (isset($_POST['seeBrand'])) {
    $see = $loadSee->render(['type' => "Marques"]);
} elseif (isset($_POST['seeColor'])) {
    $see = $loadSee->render(['type' => "Couleurs"]);
} elseif (isset($_POST['seePassenger'])) {
    $see = $loadSee->render(['type' => "Passagers"]);
} elseif (isset($_POST['allUsers'])) {
    $loadSee = $twig->load('adminSee2.twig');
    $see = $loadSee->render(['type' => "Utilisateurs"]);
} elseif (isset($_POST['allOpinion'])) {
    $loadSee = $twig->load('adminSee2.twig');
    $see = $loadSee->render(['type' => "Avis"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/header.css">
    <link rel="stylesheet" href="/assets/admin.css">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>PrendsTaGo - DashBoard</title>
    <script>
        function showSummaryModal() {
            $('#summaryModal').modal('show');
        }

        function closeSummaryModal() {
            $('#summaryModal').modal('hide');
        }
    </script>
</head>

<body>
    <?= $header ?>

    <div class="container-box">
        <div class="flex-shrink-0 p-3 bg-dark" style="width: 280px; height: 100%;">
            <a href="/" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
                <img src="/img/logo.png" width="30" height="24">
                <p></p>
                <span id="texte" class="fs-5 fw-semibold" style="margin-left: 5px;">Menu</span>
            </a>
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#brand-collapse" aria-expanded="true">
                        Marques
                    </button>
                    <div class="collapse show" id="brand-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <form method="post" action="">
                                <li><button id="texte" class="bg-dark" type="submit" name="seeBrand">Tout voir</button></li>
                            </form>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#color-collapse" aria-expanded="true">
                        Couleurs
                    </button>
                    <div class="collapse show" id="color-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <form method="post" action="">
                                <li><button id="texte" class="bg-dark" type="submit" name="seeColor">Tout voir</button></li>
                            </form>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#passenger-collapse" aria-expanded="true">
                        Passagers
                    </button>
                    <div class="collapse show" id="passenger-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <form method="post" action="">
                                <li><button id="texte" class="bg-dark" type="submit" name="seePassenger">Tout voir</button></li>
                            </form>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#vehicle-collapse" aria-expanded="true">
                        Vehicules
                    </button>
                    <div class="collapse show" id="vehicle-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <form method="post" action="">
                                <li><button id="texte" class="bg-dark" type="submit" name="allCar">Tout voir</button></li>
                                <li><button id="texte" class="bg-dark" type="submit" name="addCar">Ajouter</button></li>
                            </form>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="true">
                        Utilisateurs
                    </button>
                    <div class="collapse show" id="user-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <form method="post" action="">
                                <li><button id="texte" class="bg-dark" type="submit" name="allUsers">Tout voir</button></li>
                            </form>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#opinion-collapse" aria-expanded="true">
                        Avis
                    </button>
                    <div class="collapse show" id="opinion-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <form method="post" action="">
                                <li><button id="texte" class="bg-dark" type="submit" name="allOpinion">Tout voir</button></li>
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <div class="body-container">
            <?= $see ?>
        </div>
    </div>
</body>

</html>