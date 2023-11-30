<?php

namespace Model;

use Entity\Car;
use Config\DataBase;
use Entity\Brand;
use Entity\Color;
use Entity\Passenger;
use PDO;
use PDOException;

class CarModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createCar(Car $car)
    {
        $name = $car->getName();
        $brandId = $car->getBrand()->getId();
        $colorId = $car->getColor()->getId();
        $passengerId = $car->getPassenger()->getId();
        $picture = $car->getPicture();
        $price = $car->getPrice();
        $manual = $car->getManual();
        $type = $car->getType();
        $minAge = $car->getMinAge();
        $nbDoor = $car->getNbDoor();
        $location = $car->getLocation();

        try {
            $stmtCar = self::$conn->prepare("INSERT INTO Car (name, brandId, colorId, passengerId, picture, price, manual, type, minAge, nbDoor, location, status) 
                                            VALUES (:name, :brandId, :colorId, :passengerId, :picture, :price, :manual, :type, :minAge, :nbDoor, :location, 1)");

            $stmtCar->bindParam(":name", $name);
            $stmtCar->bindParam(":brandId", $brandId);
            $stmtCar->bindParam(":colorId", $colorId);
            $stmtCar->bindParam(":passengerId", $passengerId);
            $stmtCar->bindParam(":picture", $picture);
            $stmtCar->bindParam(":price", $price);
            $stmtCar->bindParam(":manual", $manual);
            $stmtCar->bindParam(":type", $type);
            $stmtCar->bindParam(":minAge", $minAge);
            $stmtCar->bindParam(":nbDoor", $nbDoor);
            $stmtCar->bindParam(":location", $location);

            $stmtCar->execute();

            return $car;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOneCar($carId)
    {
        try {
            $query = "SELECT Car.id, Car.name,
                (SELECT JSON_OBJECT('id', B.id, 'brandName', B.brandName)
                FROM Brand B
                WHERE B.id = Car.brandId
                ) AS brand,
                (SELECT JSON_OBJECT('id', C.id, 'colorName', C.colorName)
                FROM Color C
                WHERE C.id = Car.colorId
                ) AS color,
                (SELECT JSON_OBJECT('id', P.id, 'number', P.number)
                FROM Passenger P
                WHERE P.id = Car.passengerId
                ) AS passenger,
                Car.picture, Car.price, Car.manual, Car.type, Car.minAge, Car.nbDoor, Car.location
            FROM Car
            WHERE Car.id = $carId";

            $stmt = self::$conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $result['brand'] = new Brand(...get_object_vars(json_decode($result['brand'])));
            $result['color'] = new Color(...get_object_vars(json_decode($result['color'])));
            $result['passenger'] = new Passenger(...get_object_vars(json_decode($result['passenger'])));
            $oneCar = new Car(...$result);

            return $oneCar;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllCar()
    {
        try {
            $query = "SELECT Car.id, Car.name,
                (SELECT JSON_OBJECT('id', B.id, 'brandName', B.brandName)
                FROM Brand B
                WHERE B.id = Car.brandId
                ) AS brand,
                (SELECT JSON_OBJECT('id', C.id, 'colorName', C.colorName)
                FROM Color C
                WHERE C.id = Car.colorId
                ) AS color,
                (SELECT JSON_OBJECT('id', P.id, 'number', P.number)
                FROM Passenger P
                WHERE P.id = Car.passengerId
                ) AS passenger,
                Car.picture, Car.price, Car.manual, Car.type, Car.minAge, Car.nbDoor, Car.location
            FROM Car
            WHERE Car.status = 1";

            $stmt = self::$conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $allCar = [];
            foreach ($result as $car) {
                $car['brand'] = new Brand(...get_object_vars(json_decode($car['brand'])));
                $car['color'] = new Color(...get_object_vars(json_decode($car['color'])));
                $car['passenger'] = new Passenger(...get_object_vars(json_decode($car['passenger'])));
                $oneCar = new Car(...$car);
                array_push($allCar, $oneCar);
            }

            return $allCar;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCarsByFilter($search, $price, $brandId, $colorId, $passengerId)
    {
        $data = self::getAllCar();
        if ($search != null) {
            $tempData = [];
            foreach ($data as $one) {
                if (strpos($one->getName(), $search) !== false) {
                    array_push($tempData, $one);
                }
            }
            $data = $tempData;
        }
        if ($price != "1000") {
            $priceValue = explode("-", $price);
            $tempData = [];
            foreach ($data as $one) {
                if ($one->getprice() > floatval($priceValue[0]) && $one->getprice() < floatval($priceValue[1])) {
                    array_push($tempData, $one);
                }
            }
            $data = $tempData;
        }
        if ($brandId != "0") {
            $tempData = [];
            foreach ($data as $one) {
                if ($one->getBrand()->getId() == intval($brandId)) {
                    array_push($tempData, $one);
                }
            }
            $data = $tempData;
        }
        if ($colorId != "0") {
            $tempData = [];
            foreach ($data as $one) {
                if ($one->getColor()->getId() == intval($colorId)) {
                    array_push($tempData, $one);
                }
            }
            $data = $tempData;
        }
        if ($passengerId != "0") {
            $tempData = [];
            foreach ($data as $one) {
                if ($one->getPassenger()->getId() == intval($passengerId)) {
                    array_push($tempData, $one);
                }
            }
            $data = $tempData;
        }

        return $data;
    }

    public function updateCar($carId, Car $car)
    {
        $name = $car->getName();
        $brandId = $car->getBrand()->getId();
        $colorId = $car->getColor()->getId();
        $passengerId = $car->getPassenger()->getId();
        $picture = $car->getPicture();
        $price = $car->getPrice();
        $manual = $car->getManual();
        $type = $car->getType();
        $minAge = $car->getMinAge();
        $nbDoor = $car->getNbDoor();
        $location = $car->getLocation();

        $stmtCar = self::$conn->prepare("UPDATE Car SET name = :name, brandId = :brandId, colorId = :colorId, passengerId = :passengerId, picture = :picture, price = :price, manual = :manual, type = :type, minAge = :minAge, nbDoor = :nbDoor, location = :location WHERE id = :carId");
        $stmtCar->bindParam(":name", $name);
        $stmtCar->bindParam(":brandId", $brandId);
        $stmtCar->bindParam(":colorId", $colorId);
        $stmtCar->bindParam(":passengerId", $passengerId);
        $stmtCar->bindParam(":picture", $picture);
        $stmtCar->bindParam(":price", $price);
        $stmtCar->bindParam(":manual", $manual);
        $stmtCar->bindParam(":type", $type);
        $stmtCar->bindParam(":minAge", $minAge);
        $stmtCar->bindParam(":nbDoor", $nbDoor);
        $stmtCar->bindParam(":location", $location);
        $stmtCar->bindParam(":carId", $carId, PDO::PARAM_INT);
        $stmtCar->execute();
    }


    public function deleteCar($carId)
    {
        if (self::$conn->query("SELECT status FROM Car WHERE id = $carId")->fetchColumn() == 0) {
            try {
                $stmtCar = self::$conn->prepare("DELETE FROM Car WHERE id = :id");
                $stmtCar->bindParam(":id", $carId);
                $stmtCar->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }
}
