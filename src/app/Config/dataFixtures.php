<?php

namespace Config;

use PDO;
use PDOException;
use Faker\Factory;
use DateTime;

class DataFixtures
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function load()
    {

        // Faker
        $faker = Factory::create('fr_FR');

        try {
            $conn = self::$conn;

            // Spécificitées des voitures
            self::makeBrand($conn);
            self::makeColor($conn);
            self::makePassenger($conn);

            for ($i = 0; $i < 25; $i++) {
                self::makeUser($conn, $faker);
                if ($i == 0) {
                    $stmt = $conn->prepare("UPDATE User SET isAdmin = true WHERE id = $i + 1");
                    $stmt->execute();
                }
            }
            for ($i = 0; $i < 50; $i++) {
                self::makeCar($conn, $faker);
            }

            error_log("\033[34mDataFixtures created successfully\033[0m");
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
        }
    }

    public function makeBrand(PDO $db)
    {
        $brands = ['Nissan', 'Renault', 'Volvo', 'Tesla', 'Fiat', 'Peugeot', 'Volkswagen', 'Ferrari', 'Hyundai', 'Kia'];

        foreach ($brands as $brand) {
            try {
                $stmt = $db->prepare("INSERT INTO Brand (brandName) VALUES (:brand)");
                $stmt->bindParam(':brand', $brand);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur1 : " . $e->getMessage() . "\n";
            }
        }
    }

    public function makeColor(PDO $db)
    {
        $colors = ['Rouge', 'Blanc', 'Gris', 'Noir', 'Noir mat', 'Bleu turquoise', 'Bleu marine'];

        foreach ($colors as $color) {
            try {
                $stmt = $db->prepare("INSERT INTO Color (colorName) VALUES (:color)");
                $stmt->bindParam(':color', $color);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur2 : " . $e->getMessage() . "\n";
            }
        }
    }

    public function makePassenger(PDO $db)
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

    public function makeUser(PDO $db, \Faker\Generator $faker)
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
            self::makeAddress($db, $faker);
            $id = $db->query("SELECT MAX(id) FROM Address")->fetchColumn();
            $stmt->bindParam(':addressId', $id);
            $stmt->bindParam(':creationDate', $dateString);
            $stmt->bindParam(':newsLetter', $newsLetter);
            $stmt->bindParam(':verified', $verified);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur4 : " . $e->getMessage() . "\n";
        }
    }

    public function makeAddress(PDO $db, \Faker\Generator $faker)
    {
        $address =  $faker->address;
        $city = $faker->city;
        $code = $faker->postcode;
        $country = "France";

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

    public function makeCar(PDO $db, \Faker\Generator $faker)
    {
        $names = ["Juke", "Qashqai", "Micra", "Captur", "Clio", "Megane", "C40 Recharge", "EX90 Recharge", "EX30 Recharge", "Model e", "Model 3", "Model s", "500", "600", "Panda", "208", "3008", "508", "Golf", "ID.3", "Polo", "F8 Spider", "F488 Pista", "812 Superfast", "Ev5", "Niro", "Proceed"];
        $pictures = [
            "https://images.caradisiac.com/logos-ref/modele/modele--nissan-juke-2/S7-modele--nissan-juke-2.jpg",
            "https://images.caradisiac.com/logos-ref/modele/modele--nissan-qashqai-3/S7-modele--nissan-qashqai-3.jpg",
            "https://images.caradisiac.com/logos-ref/modele/modele--nissan-micra-4/S7-modele--nissan-micra-4.jpg",
            "https://images.caradisiac.com/logos-ref/modele/modele--renault-captur-2/S0-modele--renault-captur-2.jpg",
            "https://cdn.drivek.com/configurator-imgs/cars/fr/Original/RENAULT/CLIO/42849_HATCHBACK-5-DOORS/renault-clio-front-view.jpg",
            "https://images.caradisiac.com/logos-ref/modele/modele--renault-megane-4/S0-modele--renault-megane-4.jpg",
            "https://cdn.automobile-propre.com/uploads/2021/03/Volvo-C40-Recharge.jpg",
            "https://i.gaw.to/content/photos/54/51/545155-volvo-promet-la-recharge-bidirectionnelle-avec-son-futur-ex90.jpeg",
            "https://cdn.automobile-propre.com/uploads/2023/06/Volvo-EX30-1.jpg",
            "https://images.frandroid.com/wp-content/uploads/2023/02/tesla-model-3-compacte.jpeg",
            "https://cdn.drivek.com/configurator-imgs/cars/fr/Original/TESLA/MODEL-3/42960_BERLINE-4-PORTES/tesla-model-3-front-view.jpg",
            "https://cdn.lesnumeriques.com/optim/news/21/212855/0d3c6a71-tesla-model-s-et-model-x-leur-prix-s-allege-de-plus-de-10-000__1200_900__0-293-4000-2548.jpg",
            "https://images.caradisiac.com/logos-ref/modele/modele--fiat-500-c/S0-modele--fiat-500-c.jpg",
            "https://images.caradisiac.com/logos/7/7/6/9/277769/S7-presentation-fiat-600-e-la-500-e-des-familles-203205.jpg",
            "https://images.caradisiac.com/images/3/8/4/7/183847/S0-fiat-panda-nouvelle-serie-speciale-cool-633445.jpg",
            "https://cdn.drivek.com/configurator-imgs/cars/fr/Original/PEUGEOT/208/43018_HATCHBACK-5-DOORS/peugeot-208-front-view.jpg",
            "https://images.caradisiac.com/images/5/3/6/2/185362/S0-peugeot-3008-restyle-2020-nouvelle-gamme-les-prix-des-31-050-eur-642772.jpg",
            "https://cdn.drivek.com/configurator-imgs/cars/fr/Original/PEUGEOT/508/42088_BERLINE-5-PORTES/peugeot-508-front-view.jpg",
            "https://images.caradisiac.com/images/2/8/4/2/182842/S0-guide-d-achat-les-dix-incontournables-du-deconfinement-628839.jpg",
            "https://images.caradisiac.com/logos-ref/modele/modele--volkswagen-id-3/S0-modele--volkswagen-id-3.jpg",
            "https://upload.wikimedia.org/wikipedia/commons/thumb/3/32/VW_Polo_V_front_20100402.jpg/1200px-VW_Polo_V_front_20100402.jpg",
            "https://images.caradisiac.com/images/8/4/4/2/178442/S0-ferrari-devoile-la-f8-spider-602249.jpg",
            "https://images.caradisiac.com/logos-ref/modele/modele--ferrari-488-pista/S0-modele--ferrari-488-pista.jpg",
            "https://images.squarespace-cdn.com/content/v1/5da451740e31e4217193ce0a/1672827145931-AVHBMAJXAO3PAY4DUEF8/Joinsteer_lld_Ferrari_812_Superfast_Novitec_800_ch_0.jpg",
            "https://cdn.motor1.com/images/mgl/8AN3GM/s1/kia-ev5.jpg",
            "https://journalauto.com/wp-content/uploads/2022/07/Kia-Niro-AV.jpg",
            "https://cdn.drivek.com/configurator-imgs/cars/fr/Original/KIA/PROCEED/40719_BREAK-5-PORTES/kia-proceed-gt-2022-front-view.jpg"
        ];

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
            $colorId = $db->query("SELECT id FROM Color ORDER BY rand() LIMIT 1")->fetchColumn();
            $passengerId = $db->query("SELECT id FROM Passenger ORDER BY rand() LIMIT 1")->fetchColumn();
            $numb = rand(0, sizeof($names) - 1);
            $name = $names[$numb];
            $picture = $pictures[$numb];
            $idForParams = strval(floor($numb / 3) + 1);
            $brandId = $db->query("SELECT id FROM Brand WHERE id = $idForParams")->fetchColumn();
            $latitude = $faker->latitude(45.5, 46);
            $longitude = $faker->longitude(4.5, 5.2);


            $location = strval($latitude) . "," . strval($longitude);;
            $manual =  rand(0, 1);
            $minAge =  rand(18, 80);

            $stmt = $db->prepare("INSERT INTO Car (name, brandId, colorId, passengerId, picture, price, manual, type, minAge, nbDoor, location, status) VALUES (:name, :brandId, :colorId, :passengerId, :picture, :price, :manual, :type, :minAge, :nbDoor, :location, 1)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':brandId', $brandId);
            $stmt->bindParam(':colorId', $colorId);
            $stmt->bindParam(':passengerId', $passengerId);
            $stmt->bindParam(':picture', $picture);
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
        $beginDate->modify('+' . strval(rand(3, 14)) . ' days');
        $beginningString = $beginDate->format('Y-m-d H:i:s');


        for ($i = 0; $i < rand(2, 4); $i++) {
            $endDate = clone $beginDate;
            $endDate->modify('+' . strval(rand(3, 7)) . ' days');
            $endingString = $endDate->format('Y-m-d H:i:s');
            $userId = $db->query("SELECT id FROM User ORDER BY rand() LIMIT 1")->fetchColumn();
            self::makeReservation($db, $faker, $id, $userId, $price, $beginDate, $endDate);
            self::makeUnvailableDate($db, $id, $beginningString, $endingString);
        }

        for ($i = 0; $i < rand(2, 5); $i++) {
            $userId = $db->query("SELECT id FROM User ORDER BY rand() LIMIT 1")->fetchColumn();
            self::makeFavori($db, $id, $userId);
        }
    }

    public function makeUnvailableDate(PDO $db, int $carId, string $beginningDate, string $endingDate)
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

    public function makeFavori(PDO $db, int $carId, int $userId)
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

    public function makeReservation(PDO $db, \Faker\Generator $faker, int $carId, int $userId, float $price, DateTime $beginningDate, DateTime $endingDate)
    {
        $interval = $beginningDate->diff($endingDate);
        $day = $interval->days;
        $protection = rand(0, 1);
        if ($protection == 1) {
            $addFees = [10, 30, 50][rand(0, 2)];
        } else {
            $addFees = null;
        }
        $beginningState = $faker->text(100);
        $endingState = $faker->text(100);
        $beginningString = $beginningDate->format('Y-m-d H:i:s');
        $endingString = $endingDate->format('Y-m-d H:i:s');
        $hash = strtr(base64_encode(random_bytes(18)), '/+', '_-');

        try {
            $stmt = $db->prepare("INSERT INTO Reservation (carId, userId, hash, protection, price, beginning, ending, finish, beginningState, endingState, addFees, status) VALUES (:carId, :userId, :hash, :protection, :price, :beginning, :ending, 0, :beginningState, :endingState, :addFees, 1)");
            $stmt->bindParam(':carId', $carId);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':hash', $hash);
            $stmt->bindParam(':protection', $protection);
            $stmt->bindParam(':beginning', $beginningString);
            $stmt->bindParam(':ending', $endingString);
            $stmt->bindParam(':beginningState', $beginningState);
            $stmt->bindParam(':endingState', $endingState);
            if ($protection == 1) {
                $price = ($price + $addFees) * $day;
                $stmt->bindParam(':addFees', $addFees);
                $stmt->bindParam(':price', $price);
            } else {
                $price = $price * $day;
                $stmt->bindParam(':addFees', $addFees);
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

    public function makePilote(PDO $db, \Faker\Generator $faker, int $reservationId)
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

    public function makeOpinion(PDO $db, \Faker\Generator $faker, int $carId, int $userId, int $reservationId)
    {
        $commentary = $faker->text(200);
        $rank = rand(0, 5);
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');

        try {
            $stmt = $db->prepare("INSERT INTO Opinion (carId, userId, reservationId, commentary, `rank`, creationDate, status) VALUES (:carId, :userId, :reservationId, :commentary, :rank, :creationDate, 1)");
            $stmt->bindParam(':carId', $carId);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':reservationId', $reservationId);
            $stmt->bindParam(':commentary', $commentary);
            $stmt->bindParam(':rank', $rank);
            $stmt->bindParam(':creationDate', $dateString);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur11 : " . $e->getMessage() . "\n";
            return;
        }
    }
}
