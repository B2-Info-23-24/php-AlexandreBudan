<?php

namespace Model;

use Config\DataBase;
use Entity\Brand;
use Entity\Car;
use Entity\Color;
use Entity\Passenger;
use Entity\Pilote;
use Entity\Reservation;
use Entity\User;
use PDO;
use PDOException;

class ReservationModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createReservation(Reservation $reservation)
    {
        try {
            $userId = $reservation->getUser()->getId();
            $carId = $reservation->getCar()->getId();
            $hash = $reservation->getHash();
            $protection = (int)$reservation->getProtection();
            $price = $reservation->getPrice();
            $beginning = $reservation->getBeginning();
            $ending = $reservation->getEnding();
            $finish = (int)$reservation->getFinish();
            $beginningState = $reservation->getBeginningState();
            $endingState = $reservation->getEndingState();
            $addFees = $reservation->getAddFees();

            $stmtReservation = self::$conn->prepare("INSERT INTO Reservation (userId, carId, hash, protection, price, beginning, ending, finish, beginningState, endingState, addFees, status) 
                                            VALUES (:userId, :carId, :hash, :protection, :price, :beginning, :ending, :finish, :beginningState, :endingState, :addFees, 1)");

            $stmtReservation->bindParam(":userId", $userId);
            $stmtReservation->bindParam(":carId", $carId);
            $stmtReservation->bindParam(":hash", $hash);
            $stmtReservation->bindParam(":protection", $protection);
            $stmtReservation->bindParam(":price", $price);
            $stmtReservation->bindParam(":beginning", $beginning);
            $stmtReservation->bindParam(":ending", $ending);
            $stmtReservation->bindParam(":finish", $finish);
            $stmtReservation->bindParam(":beginningState", $beginningState);
            $stmtReservation->bindParam(":endingState", $endingState);
            $stmtReservation->bindParam(":addFees", $addFees);

            $stmtReservation->execute();

            $reservationId = self::$conn->query("SELECT MAX(id) FROM Reservation")->fetchColumn();
            $pilote = $reservation->getPilote();
            $piloteFirstName = $pilote->getFirstName();
            $piloteLastName = $pilote->getLastName();
            $piloteAge = $pilote->getAge();
            $piloteEmail = $pilote->getEmail();
            $pilotePhone = $pilote->getPhone();
            $stmtPilote = self::$conn->prepare("INSERT INTO Pilote (reservationId, firstName, lastName, age, email, phone, status) 
                                            VALUES (:reservationId, :firstName, :lastName, :age, :email, :phone, 1)");

            $stmtPilote->bindParam(":reservationId", $reservationId);
            $stmtPilote->bindParam(":firstName", $piloteFirstName);
            $stmtPilote->bindParam(":lastName", $piloteLastName);
            $stmtPilote->bindParam(":age", $piloteAge);
            $stmtPilote->bindParam(":email", $piloteEmail);
            $stmtPilote->bindParam(":phone", $pilotePhone);

            $stmtPilote->execute();

            $stmtUnvailableDate = self::$conn->prepare("INSERT INTO UnvailableDate (carId, beginning, ending) 
                                            VALUES (:carId, :beginning, :ending)");

            $stmtUnvailableDate->bindParam(":carId", $carId);
            $stmtUnvailableDate->bindParam(":beginning", $beginning);
            $stmtUnvailableDate->bindParam(":ending", $ending);

            $stmtUnvailableDate->execute();

            return $reservationId;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOneReservation(int $resaId)
    {
        try {
            $query = "SELECT 'id', Reservation.id, 
                                (SELECT JSON_OBJECT('id', Car.id, 'name', Car.name, 
                                        'brand', JSON_OBJECT('id', Brand.id, 'brandName', Brand.brandName),
                                        'color', JSON_OBJECT('id', Color.id, 'colorName', Color.colorName),
                                        'passenger', JSON_OBJECT('id', Passenger.id, 'number', Passenger.number),
                                        'picture', Car.picture, 'price', Car.price, 'manual', Car.manual, 'type', Car.type, 'minAge', Car.minAge, 'nbDoor', Car.nbDoor, 'location', Car.location)
                                    FROM Car
                                    LEFT JOIN Brand ON Car.brandId = Brand.id
                                    LEFT JOIN Color ON Car.colorId = Color.id
                                    LEFT JOIN Passenger ON Car.passengerId = Passenger.id
                                    WHERE Car.id = Reservation.carId
                                    ) AS car,
                                'user',
                                JSON_OBJECT('id', Pilote.id, 'reservationId', Pilote.reservationId, 'firstName', Pilote.firstName, 'lastName', Pilote.lastName, 'age', Pilote.age, 'email', Pilote.email, 'phone', Pilote.phone) AS pilote,
                                'hash', Reservation.hash, 'protection', Reservation.protection, 'price', Reservation.price, 'beginning', Reservation.beginning, 'ending', Reservation.ending, 'finish', Reservation.finish, 'beginningState', Reservation.beginningState, 'endingState', Reservation.endingState, 'addFees', Reservation.addFees
                                FROM Reservation
                                JOIN Pilote ON Pilote.reservationId = Reservation.id
                                WHERE Reservation.id = $resaId";
            $stmt = self::$conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $result['car'] = json_decode($result['car'], true);
            $result['pilote'] = new Pilote(...get_object_vars(json_decode($result['pilote'])));
            $result['car']['brand'] = new Brand(...$result['car']['brand']);
            $result['car']['color'] = new Color(...$result['car']['color']);
            $result['car']['passenger'] = new Passenger(...$result['car']['passenger']);
            $result['car'] = new Car(...$result['car']);
            $result['user'] = $_SESSION['user'];
            $result = new Reservation(...$result);

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getReservationsByCarId(int $carId)
    {
        try {
            $query = "SELECT 'id', Reservation.id,
                                (SELECT JSON_OBJECT('id', Car.id, 'name', Car.name, 
                                        'brand', JSON_OBJECT('id', Brand.id, 'brandName', Brand.brandName),
                                        'color', JSON_OBJECT('id', Color.id, 'colorName', Color.colorName),
                                        'passenger', JSON_OBJECT('id', Passenger.id, 'number', Passenger.number),
                                        'picture', Car.picture, 'price', Car.price, 'manual', Car.manual, 'type', Car.type, 'minAge', Car.minAge, 'nbDoor', Car.nbDoor, 'location', Car.location)
                                    FROM Car
                                    LEFT JOIN Brand ON Car.brandId = Brand.id
                                    LEFT JOIN Color ON Car.colorId = Color.id
                                    LEFT JOIN Passenger ON Car.passengerId = Passenger.id
                                    WHERE Car.id = Reservation.carId
                                ) AS car,
                                (SELECT JSON_OBJECT('id', User.id, 'email', User.email)
                                FROM User
                                WHERE User.id = Reservation.userId
                                ) AS user,
                                JSON_OBJECT('id', Pilote.id, 'reservationId', Pilote.reservationId, 'firstName', Pilote.firstName, 'lastName', Pilote.lastName, 'age', Pilote.age, 'email', Pilote.email, 'phone', Pilote.phone) AS pilote,
                                'hash', Reservation.hash, 'protection', Reservation.protection, 'price', Reservation.price, 'beginning', Reservation.beginning, 'ending', Reservation.ending, 'finish', Reservation.finish, 'beginningState', Reservation.beginningState, 'endingState', Reservation.endingState, 'addFees', Reservation.addFees
                                FROM Reservation
                                JOIN Pilote ON Pilote.reservationId = Reservation.id
                                WHERE Reservation.carId = $carId";
            $stmt = self::$conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $reservations = [];

            foreach ($result as $reservation) {
                $reservation['car'] = json_decode($reservation['car'], true);
                $reservation['pilote'] = new Pilote(...get_object_vars(json_decode($reservation['pilote'])));
                $reservation['car']['brand'] = new Brand(...$reservation['car']['brand']);
                $reservation['car']['color'] = new Color(...$reservation['car']['color']);
                $reservation['car']['passenger'] = new Passenger(...$reservation['car']['passenger']);
                $reservation['car'] = new Car(...$reservation['car']);
                $reservation['user'] = new User(...get_object_vars(json_decode($reservation['user'])));
                $reservation = new Reservation(...$reservation);
                array_push($reservations, $reservation);
            }

            return $reservations;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteReservation(int $id, int $carId)
    {
        try {
            $stmtPilote = self::$conn->prepare("DELETE FROM Pilote WHERE reservationId = :id");
            $stmtPilote->bindParam(":id", $id);
            $stmtPilote->execute();

            $stmtUnvailableDate = self::$conn->prepare("DELETE FROM UnvailableDate WHERE carId = :carId");
            $stmtUnvailableDate->bindParam(":carId", $carId);
            $stmtUnvailableDate->execute();

            $stmtOpinion = self::$conn->prepare("DELETE FROM Opinion WHERE carId = :carId");
            $stmtOpinion->bindParam(":carId", $carId);
            $stmtOpinion->execute();

            $stmtReservation = self::$conn->prepare("DELETE FROM Reservation WHERE id = :id");
            $stmtReservation->bindParam(":id", $id);
            $stmtReservation->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
