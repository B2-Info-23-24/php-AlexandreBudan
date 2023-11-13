<?php

require_once realpath('./vendor/autoload.php');

// DotEnv
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

// Faker
$faker = Faker\Factory::create();

$servername = $_ENV['DB_SERVERNAME'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Chemin vers le fichier SQL
    $sqlFile = './db.sql';

    // Lit le contenu du fichier SQL
    $sql = file_get_contents($sqlFile);

    // Exécute les requêtes SQL
    $conn->exec($sql);

    echo "Tables créées avec succès\n";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}

$conn = null;

function makeFixtures(PDO $db)
{

    // Spécificitées des voitures
    makeBrand($db);
    makeColor($db);
    makePassenger($db);
}

function makeUser(PDO $db, Faker\Generator $faker)
{
    $firstName = $faker->firstName();
    $lastName = $faker->lastName;
    $password = password_hash($firstName . $lastName, PASSWORD_DEFAULT);
    $genders = ["Women", "Men", "Other"];

    try {
        $stmt = $db->prepare("INSERT INTO User (email, password, firstName, lastName, phone, age, gender, adressId, creationDate, newsLetter, verified, isAdmin, status) VALUES (:email, :password, :firstName, :lastName, :phone, :age, :gender, :adressId, :creationDate, :newsLetter, :verified, false, true)");
        $stmt->bindParam(':email', $firstName . "." . $lastName . "@gmail.com");
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':phone', $faker->phoneNumber);
        $stmt->bindParam(':age', rand(18, 80));
        $stmt->bindParam(':gender', $genders[rand(0, 2)]);
        if ((bool)rand(0, 1)) {
            makeAdress($db, $faker);
            // $rqut_nb = $db->prepare("SELECT COUNT( date_releve ) as recuperation FROM releve_conso_elec;");

            // $ligne = $nb - 7;

            // // 4 - Récupération des lignes
            // $query = "SELECT * FROM `releve_conso_elec` LIMIT $ligne , $nb";
            // $result = mysql_query($query);
            $stmt->bindParam(':adressId', $id);
        } else {
            $stmt->bindParam(':adressId', null);
        }
        $stmt->bindParam(':creationDate', new DateTime());
        $stmt->bindParam(':newsLetter', (bool)rand(0, 1));
        $stmt->bindParam(':verified', (bool)rand(0, 1));
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "\n";
    }
}

function makeAdress(PDO $db, Faker\Generator $faker)
{
    try {
        $stmt = $db->prepare("INSERT INTO Adress (address, city, code, country, status) VALUES (:address, :city, :code, :country, true)");
        $stmt->bindParam(':address', $faker->address);
        $stmt->bindParam(':city', $faker->city);
        $stmt->bindParam(':code', $faker->countryCode);
        $stmt->bindParam(':country', $faker->country);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "\n";
    }
}

function makeBrand(PDO $db)
{
    $brands = ['Nissan', 'Renault', 'Volvo', 'Tesla', 'Fiat', 'Peugeot', 'Volkswagen', 'Ferrari', 'Hyundai', 'Kia'];

    foreach ($brands as $brand) {
        try {
            $stmt = $db->prepare("INSERT INTO Brand (name) VALUES (:brand)");
            $stmt->bindParam(':brand', $brand);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }
}

function makeColor(PDO $db)
{
    $colors = ['Rouge', 'Blanc', 'Gris', 'Noir', 'Noir mat', 'Bleu turquoise', 'Bleu marine'];

    foreach ($colors as $color) {
        try {
            $stmt = $db->prepare("INSERT INTO Color (name) VALUES (:color)");
            $stmt->bindParam(':color', $color);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }
}

function makePassenger(PDO $db)
{
    $passengers = [2, 3, 4, 5, 7, 9];

    foreach ($passengers as $passenger) {
        try {
            $stmt = $db->prepare("INSERT INTO Passenger (number) VALUES (:passenger)");
            $stmt->bindParam(':passenger', $passenger);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }
}
