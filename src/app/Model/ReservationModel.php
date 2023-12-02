<?php

namespace Model;

use Entity\Address;
use Config\DataBase;
use Entity\Reservation;
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
            $price = $reservation->getPrice();
            $beginning = $reservation->getBeginning();
            $ending = $reservation->getEnding();
            $finish = $reservation->getFinish();
            $beginningState = $reservation->getBeginningState();
            $endingState = $reservation->getEndingState();
            $addFees = $reservation->getAddFees();

            $stmtReservation = self::$conn->prepare("INSERT INTO Reservation (userId, carId, hash, price, beginning, ending, finish, beginningState, endingState, addFees, status) 
                                            VALUES (:userId, :carId, :hash, :price, :beginning, :ending, :finish, :beginningState, :endingState, :addFees, 1)");

            $stmtReservation->bindParam(":userId", $userId);
            $stmtReservation->bindParam(":carId", $carId);
            $stmtReservation->bindParam(":hash", $hash);
            $stmtReservation->bindParam(":price", $price);
            $stmtReservation->bindParam(":beginning", $beginning);
            $stmtReservation->bindParam(":ending", $ending);
            $stmtReservation->bindParam(":finish", $finish);
            $stmtReservation->bindParam(":beginningState", $beginningState);
            $stmtReservation->bindParam(":endingState", $endingState);
            $stmtReservation->bindParam(":addFees", $addFees);

            $stmtReservation->execute();

            $reservationId = self::$conn->query("SELECT MAX(id) FROM Reservation")->fetchColumn();

            return $reservationId;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
