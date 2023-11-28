<?php

namespace Model;

use Entity\Passenger;
use Config\DataBase;
use PDOException;

class PassengerModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createPassenger(string $number)
    {
        try {

            $stmtPassenger = self::$conn->prepare("INSERT INTO Passenger (number) VALUES (:number)");
            $stmtPassenger->bindParam(":number", $number);

            $stmtPassenger->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllPassenger()
    {
        try {
            $stmtPassenger = self::$conn->prepare("SELECT * FROM Passenger");
            $stmtPassenger->execute();

            $passengers = $stmtPassenger->fetchAll();

            $passengerList = [];

            foreach ($passengers as $passenger) {
                $passenger = new Passenger($passenger['id'], $passenger['number']);
                array_push($passengerList, $passenger);
            }

            return $passengerList;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletePassenger($id)
    {
        try {
            $stmtPassenger = self::$conn->prepare("DELETE FROM Passenger WHERE id = :id");
            $stmtPassenger->bindParam(":id", $id);
            $stmtPassenger->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
