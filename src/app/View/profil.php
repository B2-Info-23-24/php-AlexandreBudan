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
    <link rel="stylesheet" href="/assets/profil.css">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>PrendsTaGo - Profil</title>
</head>

<body>
    <?= $header ?>

    <div class="containerBox bg">
        <h1>Informations Personnels</h1>
        <div class="box">
            <div class="box-body">
                <label for="fname">Prénom :</label>
                <label class="box-label" for="fname">John</label>
            </div>
            <div class="box-body">
                <label for="lname">Nom :</label>
                <label class="box-label" for="lname">Doe</label>
            </div>
        </div>
        <p></p>
        <div class="box">
            <div class="box-body">
                <label for="fname">Email :</label>
                <label class="box-label" for="fname">John.Doe@gmail.com</label>
            </div>
        </div>
        <p></p>
        <div class="box">
            <button onclick="afficheModifInfo()">Modifier Nom et Prénom</button>
        </div>
        <p></p>
        <div id="form-NP" class="hidden">
            <form action="" method="post">
                <h2>Modifier nom et prénom</h2>
                <div class="form-group">
                    <label for="firstName">Prénom :</label>
                    <input type="text" id="firstName" name="firstName" value="John" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Nom :</label>
                    <input type="text" id="lastName" name="lastName" value="Doe" required>
                </div>
                <button type="submit" onclick="closeModifInfo()">Enregistrer</button>
            </form>
        </div>
        <p></p>
        <div class="box">
            <div class="box-body">
                <label for="phone">Téléphone :</label>
                <label class="box-label" for="phone">00.00.00.00.00</label>
            </div>
            <div class="box-body">
                <label for="gender">Genre :</label>
                <label class="box-label" for="gender">Homme</label>
            </div>
        </div>
        <p></p>
        <div class="box">
            <div class="box-body">
                <label for="pass">Password :</label>
                <label class="box-label" for="pass">*********</label>
            </div>
        </div>
        <p></p>
        <div class="box">
            <button onclick="afficheModifMdp()">Modifier Mot de passe</button>
        </div>
        <p></p>
        <div id="form-mdp" class="hidden">
            <form action="" method="post">
                <h2>Modifier mot de passe</h2>
                <div class="form-group">
                    <label for="currentPass">Mot de passe actuel :</label>
                    <input type="password" id="currentPass" name="currentPass" required>
                </div>
                <div class="form-group">
                    <label for="newPass">Nouveau mot de passe :</label>
                    <input type="password" id="newPass" name="newPass" required>
                </div>
                <button type="submit" onclick="closeModifMdp()">Enregistrer</button>
            </form>
        </div>
        <p></p>
        <div class="address">
            <h2>Adresse enregistré</h2>
            <p></p>
            <div class="box">
                <div class="box-body">
                    <label for="address">Adresse :</label>
                    <label class="box-label" for="address">1 allée de Rien</label>
                </div>
                <div class="box-body">
                    <label for="city">Ville :</label>
                    <label class="box-label" for="city">Vil</label>
                </div>
            </div>
            <p></p>
            <div class="box">
                <div class="box-body">
                    <label for="postalCode">Code Postal :</label>
                    <label class="box-label" for="postalCode">00000</label>
                </div>
                <div class="box-body">
                    <label for="country">Pays :</label>
                    <label class="box-label" for="country">Pé-I</label>
                </div>
            </div>
            <p></p>
            <div class="box">
                <button onclick="afficheModifAdresse()">Modifier Adresse</button>
            </div>
            <p></p>
            <div id="form-add" class="hidden">
                <form action="" method="post">
                    <h2>Modifier adresse</h2>
                    <div class="form-group">
                        <label for="address">Adresse :</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="city">Ville :</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="postalCode">Code postal :</label>
                        <input type="text" id="postalCode" name="postalCode" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Pays :</label>
                        <input type="text" id="country" name="country" required>
                    </div>
                    <button type="submit" onclick="closeModifAdresse()">Enregistrer</button>
                </form>
            </div>
            <p></p>
            <form action="" method="post">
                <h2>Ajouter une adresse</h2>
                <div class="form-group">
                    <label for="address">Adresse :</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="city">Ville :</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="postalCode">Code postal :</label>
                    <input type="text" id="postalCode" name="postalCode" required>
                </div>
                <div class="form-group">
                    <label for="country">Pays :</label>
                    <input type="text" id="country" name="country" required>
                </div>
                <button type="submit">Enregistrer</button>
            </form>
            <p></p>
        </div>
        <p></p>
        <div>
            <h2>Réservations</h2>
            <div class="container-fav">
                <div class="boxbox">
                    <a href="/">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="https://www.automobile-magazine.fr/asset/cms/198854/config/146547/p90462506-highres.jpg">
                            </img>
                            <div class="card-body">
                                <h5>Informations Reservation</h5>
                                <p class="card-text">- Début : 03/03/2003 15:00</p>
                                <p class="card-text">- Fin : 03/03/2003 15:00</p>
                                <p class="card-text">
                                <h6>- Cout : 500€</h6>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">BMW M3</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Noir</button>
                                    </div>
                                    <small class="text-body-secondary">En cours</small>
                                </div>
                                <p></p>
                                <div class="ctr">
                                    <button type="submit">Annuler la réservation</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <p></p>
        <div>
            <h2>Favoris</h2>
            <div class="container-fav">
                <div class="col boxbox">
                    <a href="/vehicule">
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
                <div class="col boxbox">
                    <a href="/vehicule">
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
                <div class="col boxbox">
                    <a href="/vehicule">
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
            </div>
        </div>
    </div>

    <?= $footer ?>

    <script>
        function afficheModifInfo() {
            var formulaire = document.getElementById('form-NP');
            formulaire.classList.remove('hidden');
        }

        function closeModifInfo() {
            var formulaire = document.getElementById('form-NP');
            formulaire.classList.add('hidden');
        }

        function afficheModifMdp() {
            var formulaire = document.getElementById('form-mdp');
            formulaire.classList.remove('hidden');
        }

        function closeModifMdp() {
            var formulaire = document.getElementById('form-mdp');
            formulaire.classList.add('hidden');
        }

        function afficheModifAdresse() {
            var formulaire = document.getElementById('form-add');
            formulaire.classList.remove('hidden');
        }

        function closeModifAdresse() {
            var formulaire = document.getElementById('form-add');
            formulaire.classList.add('hidden');
        }
    </script>
</body>

</html>