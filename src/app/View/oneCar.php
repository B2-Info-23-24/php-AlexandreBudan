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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/onecar.css">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>PrendsTaGo - Une Voiture</title>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeq2hPzggF1UpPuHe8A3qao36F9OuAlvc&callback=initMap" defer></script>
    <script>
        function initMap() {
            var myLatLng = {
                lat: 40.7128,
                lng: -74.0060
            };

            var mapOptions = {
                center: myLatLng,
                zoom: 15
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Localisation'
            });
        }

        function showSummaryModal() {
            var carFeatures = "Informations réservation:\n- Date de début : 03/03/2003\n- Date de Fin : 03/03/2003\n- Nombres de jours : 0\n\nModèle:\n- Marque : BMW\n- Couleur : Gris\n- Manuelle / Automatique : Manuelle\n\nCaractéristiques:\n- Nombres de portes : 5\n- Age minimum : 21\n- Nombres de passagers maximum : 5\n- Protection : Protection Totale(50€)\n\nRécupération: Lyon Perrache\n\nInformations Pilote:\n- Nom : Doe\n- Prénom : John\n- Age : 21\n- Email : John.Doe@gmail.com\n- Téléphone : 00.00.00.00.00\n\nRéservation sous le compte : Aucun compte";

            document.getElementById('summaryModal').getElementsByClassName('modal-body')[0].innerText = carFeatures;

            $('#summaryModal').modal('show');
        }

        function closeSummaryModal() {
            $('#summaryModal').modal('hide');
        }
    </script>
</head>

<body>
    <?= $header ?>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div id="texte" class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">BMW</h1>
            </div>
        </div>
    </section>
    <div class="col bg">
        <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="https://www.automobile-magazine.fr/asset/cms/198854/config/146547/p90462506-highres.jpg" alt="Car Photo">
            <div class="card-body">
                <h5>Caractéristiques</h5>
                <p class="card-text">- Nombres de portes : 5</p>
                <p class="card-text">- Age minimum : 21</p>
                <p class="card-text">- Nombres de passagers maximum : 5</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">BMW</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Noir</button>
                    </div>
                    <small class="text-body-secondary">Manuelle - type</small>
                </div>
                <p></p>
                <h5>Options</h5>
                <div class="radio-group">
                    <p></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="options" id="radio1" checked>
                        <label class="form-check-label" for="radio1">
                            Pas de protection
                        </label>
                    </div>
                    <p></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="options" id="radio2">
                        <label class="form-check-label" for="radio2">
                            Protection partiel (10 €)
                        </label>
                    </div>
                    <p></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="options" id="radio3">
                        <label class="form-check-label" for="radio3">
                            Protection moyenne (30 €)
                        </label>
                    </div>
                    <p></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="options" id="radio4">
                        <label class="form-check-label" for="radio4">
                            Protection totale (50 €)
                        </label>
                    </div>
                    <p></p>
                </div>
                <p></p>
                <h5>Point de Récupération</h5>
                <div id="map"></div>
                <p></p>
                <h5>Informations du pilote</h5>
                <div class="form-group">
                    <label for="lname">Nom :</label>
                    <input type="text" id="lname" name="lname" required>
                </div>
                <div class="form-group">
                    <label for="fname">Prénom :</label>
                    <input type="text" id="fname" name="fname" required>
                </div>
                <div class="form-group">
                    <label for="age">Age :</label>
                    <input type="text" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone : </label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <p></p>
                <div class="reserv">
                    <input type="submit" value="Réserver" onclick="showSummaryModal()">
                </div>

                <div class="modal" id="summaryModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Récapitulatif de la réservation</h5>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeSummaryModal()">Payer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeSummaryModal()">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $footer ?>
</body>

</html>