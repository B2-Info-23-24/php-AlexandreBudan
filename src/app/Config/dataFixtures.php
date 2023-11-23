<?php

namespace Config;

use PDO;
use PDOException;
use Faker\Factory;
use DateTime;

class DataFixtures
{
    public static function load()
    {

        // Faker
        $faker = Factory::create();

        try {
            $conn = DataBase::connect();

            // Spécificitées des voitures
            self::makeBrand($conn);
            self::makeColor($conn);
            self::makePassenger($conn);

            for ($i = 0; $i < 25; $i++) {
                self::makeUser($conn, $faker);
            }
            for ($i = 0; $i < 20; $i++) {
                self::makeCar($conn, $faker);
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }

    public static function makeBrand(PDO $db)
    {
        $brands = ['Nissan', 'Renault', 'Volvo', 'Tesla', 'Fiat', 'Peugeot', 'Volkswagen', 'Ferrari', 'Hyundai', 'Kia'];

        foreach ($brands as $brand) {
            try {
                $stmt = $db->prepare("INSERT INTO Brand (name) VALUES (:brand)");
                $stmt->bindParam(':brand', $brand);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur1 : " . $e->getMessage() . "\n";
            }
        }
    }

    public static function makeColor(PDO $db)
    {
        $colors = ['Rouge', 'Blanc', 'Gris', 'Noir', 'Noir mat', 'Bleu turquoise', 'Bleu marine'];

        foreach ($colors as $color) {
            try {
                $stmt = $db->prepare("INSERT INTO Color (name) VALUES (:color)");
                $stmt->bindParam(':color', $color);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur2 : " . $e->getMessage() . "\n";
            }
        }
    }

    public static function makePassenger(PDO $db)
    {
        $passengers = [2, 3, 4, 5, 7, 9];

        foreach ($passengers as $passenger) {
            try {
                $stmt = $db->prepare("INSERT INTO Passenger (number) VALUES (:passenger)");
                $stmt->bindParam(':passenger', $passenger);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur3 : " . $e->getMessage() . "\n";
            }
        }
    }

    public static function makeUser(PDO $db, \Faker\Generator $faker)
    {
        $firstName = $faker->firstName;
        $lastName = $faker->lastName;
        $password = password_hash($firstName . $lastName, PASSWORD_DEFAULT);
        $genders = ["Women", "Men", "Other"];
        $email = $firstName . "." . $lastName . "@gmail.com";
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');
        $phone = $faker->phoneNumber;
        $age =  rand(18, 80);
        $newsLetter = rand(0, 1);
        $verified = rand(0, 1);

        try {
            $stmt = $db->prepare("INSERT INTO User (email, password, firstName, lastName, phone, age, gender, addressId, creationDate, newsLetter, verified, isAdmin, status) VALUES (:email, :password, :firstName, :lastName, :phone, :age, :gender, :addressId, :creationDate, :newsLetter, :verified, 0, 1)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':gender', $genders[rand(0, 2)]);
            if ((bool)rand(0, 1)) {
                self::makeAddress($db, $faker);
                $id = $db->query("SELECT MAX(id) FROM Address")->fetchColumn();
                $stmt->bindParam(':addressId', $id);
            } else {
                $adressId = null;
                $stmt->bindParam(':addressId', $adressId);
            }
            $stmt->bindParam(':creationDate', $dateString);
            $stmt->bindParam(':newsLetter', $newsLetter);
            $stmt->bindParam(':verified', $verified);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur4 : " . $e->getMessage() . "\n";
        }
    }

    public static function makeAddress(PDO $db, \Faker\Generator $faker)
    {
        $address =  $faker->address;
        $city = $faker->city;
        $code = $faker->countryCode;
        $country = $faker->country;

        try {
            $stmt = $db->prepare("INSERT INTO Address (address, city, code, country, status) VALUES (:address, :city, :code, :country, 1)");
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':country', $country);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur5 : " . $e->getMessage() . "\n";
        }
    }

    public static function makeCar(PDO $db, \Faker\Generator $faker)
    {
        $types = ["Car", "Van", "Luxury"];
        $type = $types[rand(0, 2)];
        $price = (float)(rand(3000, 20000) / 100);
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
            $id = $db->query("SELECT MAX(id) FROM Car")->fetchColumn() + 1 ?? 1;
            $brandId = $db->query("SELECT id FROM Brand ORDER BY rand() LIMIT 1")->fetchColumn();
            $colorId = $db->query("SELECT id FROM Color ORDER BY rand() LIMIT 1")->fetchColumn();
            $passengerId = $db->query("SELECT id FROM Passenger ORDER BY rand() LIMIT 1")->fetchColumn();
            $name = $type . strval($id);
            $location = strval($faker->latitude) . ":" . strval($faker->longitude);
            $manual =  rand(0, 1);
            $minAge =  array_rand([null, 18]);

            $stmt = $db->prepare("INSERT INTO Car (name, brandId, colorId, passengerId, price, manual, type, minAge, nbDoor, location, status) VALUES (:name, :brandId, :colorId, :passengerId, :price, :manual, :type, :minAge, :nbDoor, :location, 1)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':brandId', $brandId);
            $stmt->bindParam(':colorId', $colorId);
            $stmt->bindParam(':passengerId', $passengerId);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':manual', $manual);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':minAge', $minAge);
            $stmt->bindParam(':nbDoor', $nbDoor);
            $stmt->bindParam(':location', $location);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur6 : " . $e->getMessage() . "\n";
        }

        $beginDate = new DateTime();
        $beginDate->modify('+1 month');
        $beginningString = $beginDate->format('Y-m-d H:i:s');


        for ($i = 0; $i < rand(2, 4); $i++) {
            $endDate = clone $beginDate;
            $endDate->modify('+' . strval(rand(3, 7)) . ' days');
            $endingString = $endDate->format('Y-m-d H:i:s');
            $userId = $db->query("SELECT id FROM User ORDER BY rand() LIMIT 1")->fetchColumn();
            self::makeReservation($db, $faker, $id, $userId, $price, $beginDate, $endDate);
            self::makeUnvailableDate($db, $id, $beginningString, $endingString);
            $beginDate->modify('+' . strval(rand(3, 7)) . ' days');
        }

        for ($i = 0; $i < rand(2, 5); $i++) {
            $userId = $db->query("SELECT id FROM User ORDER BY rand() LIMIT 1")->fetchColumn();
            self::makeFavori($db, $id, $userId);
        }
    }

    public static function makeUnvailableDate(PDO $db, int $carId, string $beginningDate, string $endingDate)
    {
        try {
            $stmt = $db->prepare("INSERT INTO UnvailableDate (carId, beginning, ending) VALUES (:carId, :beginning, :ending)");
            $stmt->bindParam(':carId', $carId);
            $stmt->bindParam(':beginning', $beginningDate);
            $stmt->bindParam(':ending', $endingDate);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur7 : " . $e->getMessage() . "\n";
        }
    }

    public static function makeFavori(PDO $db, int $carId, int $userId)
    {
        try {
            $stmt = $db->prepare("INSERT INTO Favori (userId, carId, status) VALUES (:userId, :carId, 1)");
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':carId', $carId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur8 : " . $e->getMessage() . "\n";
        }
    }

    public static function makeReservation(PDO $db, \Faker\Generator $faker, int $carId, int $userId, float $price, DateTime $beginningDate, DateTime $endingDate)
    {
        $interval = $beginningDate->diff($endingDate);
        $day = $interval->days;
        $protection = rand(0, 1);
        $addFees = (float)(rand(3000, 10000) / 100);
        $beginningState = $faker->text(100);
        $endingState = $faker->text(100);
        $beginningString = $beginningDate->format('Y-m-d H:i:s');
        $endingString = $endingDate->format('Y-m-d H:i:s');

        try {
            $stmt = $db->prepare("INSERT INTO Reservation (carId, userId, protection, price, beginning, ending, finish, beginningState, endingState, addFees, status) VALUES (:carId, :userId, :protection, :price, :beginning, :ending, 0, :beginningState, :endingState, :addFees, 1)");
            $stmt->bindParam(':carId', $carId);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':protection', $protection);
            $stmt->bindParam(':beginning', $beginningString);
            $stmt->bindParam(':ending', $endingString);
            $stmt->bindParam(':beginningState', $beginningState);
            $stmt->bindParam(':endingState', $endingState);
            if ($protection) {
                $price = ($price + $addFees) * $day;
                $stmt->bindParam(':addFees', $addFees);
                $stmt->bindParam(':price', $price);
            } else {
                $price = $price * $day;
                $addF = null;
                $stmt->bindParam(':addFees', $addF);
                $stmt->bindParam(':price', $price);
            }
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur9 : " . $e->getMessage() . "\n";
        }

        $reservationId = $db->query("SELECT MAX(id) FROM Reservation")->fetchColumn() ?? 1;
        self::makePilote($db, $faker, $reservationId);
        self::makeOpinion($db, $faker, $carId, $userId, $reservationId);
    }

    public static function makePilote(PDO $db, \Faker\Generator $faker, int $reservationId)
    {
        $firstName = $faker->firstName;
        $lastName = $faker->lastName;
        $email =  $firstName . "." . $lastName . "@gmail.com";
        $phone = $faker->phoneNumber;
        $age = rand(18, 80);

        try {
            $stmt = $db->prepare("INSERT INTO Pilote (reservationId, firstName, lastName, age, email, phone, status) VALUES (:reservationId, :firstName, :lastName, :age, :email, :phone, 1)");
            $stmt->bindParam(':reservationId', $reservationId);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur10 : " . $e->getMessage() . "\n";
        }
    }

    public static function makeOpinion(PDO $db, \Faker\Generator $faker, int $carId, int $userId, int $reservationId)
    {
        $commentary = $faker->text(200);
        $rank = rand(0, 5);
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');

        try {
            $stmt = $db->prepare("INSERT INTO Opinion (carId, userId, reservationId, commentary, rank, creationDate, status) VALUES (:userId, :carId, :reservationId, :commentary, :rank, :creationDate, 1)");
            $stmt->bindParam(':carId', $carId);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':reservationId', $reservationId);
            $stmt->bindParam(':commentary', $commentary);
            $stmt->bindParam(':rank', $rank);
            $stmt->bindParam(':creationDate', $dateString);
            $stmt->execute();
        } catch (PDOException $e) {
            return;
        }
    }
}
