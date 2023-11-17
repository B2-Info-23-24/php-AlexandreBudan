<?php

// Configuration de Twig avec le répertoire des templates
$loader = new \Twig\Loader\FilesystemLoader('../app/View/templates');
$twig = new \Twig\Environment($loader);

// Rendu du template Twig
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
    <header>
        <?= $header ?>
    </header>

    <div class="container">
        <h1>Profil</h1>

        <!-- Formulaire pour modifier le nom et le prénom -->
        <form action="modifier_nom_prenom.php" method="post">
            <h2>Modifier nom et prénom</h2>
            <div class="form-group">
                <label for="firstName">Prénom :</label>
                <input type="text" id="firstName" name="firstName" value="John" required>
            </div>
            <div class="form-group">
                <label for="lastName">Nom :</label>
                <input type="text" id="lastName" name="lastName" value="Doe" required>
            </div>
            <button type="submit">Enregistrer</button>
        </form>
        <p></p>

        <!-- Formulaire pour modifier le mot de passe -->
        <form action="modifier_mot_de_passe.php" method="post">
            <h2>Modifier mot de passe</h2>
            <div class="form-group">
                <label for="currentPassword">Mot de passe actuel :</label>
                <input type="password" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="form-group">
                <label for="newPassword">Nouveau mot de passe :</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <button type="submit">Enregistrer</button>
        </form>
        <p></p>

        <!-- Formulaire pour ajouter une adresse -->
        <form action="ajouter_adresse.php" method="post">
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

        <!-- Affichage résa futures et passées -->
        <form action="ajouter_adresse.php" method="post">
            <h2>Réservations</h2>
        </form>
    </div>

    <footer class="bg-dark">
        <?= $footer ?>
    </footer>
</body>

</html>