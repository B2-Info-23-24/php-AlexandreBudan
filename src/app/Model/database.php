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

function makeFixtures(PDO $db, Faker\Generator $faker)
{
    makeUser($db, $faker);

    // Spécificitées des voitures
    makeBrand($db);
    makeColor($db);
    makePassenger($db);
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
            try {
                $id = $db->query("SELECT id FROM Adress WHERE id = (SELECT MAX(id) FROM Adress)")->fetchColumn();
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage() . "\n";
            }
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

function makeCar(PDO $db, Faker\Generator $faker)
{
    $types = ["Car", "Van", "Luxury"];
    $type = $types[rand(0, 2)];
    try {
        $nb = $db->query("SELECT COUNT(*) FROM Car;")->fetchColumn();
        $ligne = $nb - 1;
        $id = $db->query("SELECT id FROM Car LIMIT $ligne , $nb")->fetchColumn();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "\n";
    }
    // BrandId
    $brandId = $db->query("SELECT id FROM Brand ORDER BY rand() LIMIT 1")->fetchColumn();
    $colorId = $db->query("SELECT id FROM Color ORDER BY rand() LIMIT 1")->fetchColumn();
    $passengerId = $db->query("SELECT id FROM Passenger ORDER BY rand() LIMIT 1")->fetchColumn();
    $nbDoor = 5;
    switch ($type) {
        case 'Car':
            $nbDoor = 5;
            break;
        case 'Van':
            $nbDoor = 7;
            break;
        case 'Luxury':
            $nbDoor = 3;
            break;
    }
    try {
        $stmt = $db->prepare("INSERT INTO Car (name, brandId, colorId, passengerId, price, manual, type, minAge, nbDoor, location, status) VALUES (:name, :brandId, :colorId, :passengerId, :price, :manual, :type, :minAge, :nbDoor, :location, true)");
        $stmt->bindParam(':name', $type . $id);
        $stmt->bindParam(':brandId', $brandId);
        $stmt->bindParam(':colorId', $colorId);
        $stmt->bindParam(':passengerId', $passengerId);
        $stmt->bindParam(':price', (float)(rand(3000, 20000) / 100));
        $stmt->bindParam(':manual', (bool)rand(0, 1));
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':minAge', array_rand([null, 18]));
        $stmt->bindParam(':nbDoor', $nbDoor);
        $stmt->bindParam(':location', strval($faker->latitude) . ":" . strval($faker->longitude));
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "\n";
    }
}

function makeUnvailableDate(PDO $db, Faker\Generator $faker, int $carId)
{
    try {
        $stmt = $db->prepare("INSERT INTO UnvailableDate (address, city, code, country, status) VALUES (:address, :city, :code, :country, true)");
        $stmt->bindParam(':address', $faker->address);
        $stmt->bindParam(':city', $faker->city);
        $stmt->bindParam(':code', $faker->countryCode);
        $stmt->bindParam(':country', $faker->country);
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
