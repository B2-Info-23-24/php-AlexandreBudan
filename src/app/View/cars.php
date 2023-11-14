<?php
// Inclure l'autoloader de Composer
require_once './vendor/autoload.php';

// Configuration de Twig avec le répertoire des templates
$loader = new \Twig\Loader\FilesystemLoader('/templates');
$twig = new \Twig\Environment($loader);

// Rendu du template Twig
$header = $twig->render('header.twig');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/src/public/assets/header.css">
    <link rel="icon" href="/src/public/img/logo.png" type="image/png">
    <title>PrendsTaGo - Cars</title>
</head>

<body>
    <?= $header ?>

    <h1>Cars Page</h1>

</body>

</html>