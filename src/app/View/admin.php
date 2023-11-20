<?php

// Configuration de Twig avec le répertoire des templates
$loader = new \Twig\Loader\FilesystemLoader('../app/View/templates');
$twig = new \Twig\Environment($loader);

$twig->addGlobal('type', "Marques");

// Rendu des templates Twig
$header = $twig->render('header.twig');
$footer = $twig->render('footer.twig');
$see = $twig->render('adminSee.twig');

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

        function changePage(string) {
            document.getElementById("type1").innerHTML = string;
            document.getElementById("type2").innerHTML = "Ajouter " + string;
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
                            <li><button id="texte" class="bg-dark" type="submit" onclick="changePage('Marques')">Tout voir</button></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#color-collapse" aria-expanded="true">
                        Couleurs
                    </button>
                    <div class="collapse show" id="color-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><button id="texte" class="bg-dark" type="submit" onclick="changePage('Couleurs')">Tout voir</button></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#passenger-collapse" aria-expanded="true">
                        Passagers
                    </button>
                    <div class="collapse show" id="passenger-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><button id="texte" class="bg-dark" type="submit" onclick="changePage('Passagers')">Tout voir</button></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#vehicle-collapse" aria-expanded="true">
                        Vehicules
                    </button>
                    <div class="collapse show" id="vehicle-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><button id="texte" class="bg-dark" type="submit" onclick="">Tout voir</button></li>
                            <li><button id="texte" class="bg-dark" type="submit" onclick="">Ajouter</button></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="true">
                        Utilisateurs
                    </button>
                    <div class="collapse show" id="user-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><button id="texte" class="bg-dark" type="submit" onclick="changePage('Marques')">Tout voir</button></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button id="texte" class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#opinion-collapse" aria-expanded="true">
                        Avis
                    </button>
                    <div class="collapse show" id="opinion-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><button id="texte" class="bg-dark" type="submit" onclick="changePage('Marques')">Tout voir</button></li>
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