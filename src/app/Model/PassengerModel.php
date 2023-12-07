<?php

namespace Model;

use Entity\Passenger;
use Config\DataBase;
use PDO;
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
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOnePassenger($id)
    {
        try {
            $stmtPassenger = self::$conn->query("SELECT * FROM Passenger WHERE id = $id");

            $result = $stmtPassenger->fetch(PDO::FETCH_ASSOC);

            $passenger = new Passenger(...$result);

            return $passenger;
        } catch (PDOException $e) {
            echo $e->getMessage();
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
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function checkCreate($number)
    {
        try {
            $stmtPassenger = self::$conn->prepare("SELECT * FROM Passenger WHERE number = :number");
            $stmtPassenger->bindParam(":number", $number);
            $stmtPassenger->execute();
            if ($stmtPassenger->rowCount() > 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
