<?php

namespace Model;

use Entity\Address;
use Config\DataBase;
use PDOException;

class AddressModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createAddress(Address $address)
    {
        try {
            $addressAdd = $address->getAddress();
            $city = $address->getCity();
            $code = $address->getCode();
            $country = $address->getCountry();

            $stmtAddress = self::$conn->prepare("INSERT INTO Address (address, city, code, country, status) 
                                            VALUES (:address, :city, :code, :country, 1)");
            $stmtAddress->bindParam(":address", $addressAdd);
            $stmtAddress->bindParam(":city", $city);
            $stmtAddress->bindParam(":code", $code);
            $stmtAddress->bindParam(":country", $country);

            $stmtAddress->execute();

            $addressid = self::$conn->query("SELECT MAX(id) FROM Address")->fetchColumn();

            return $addressid;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
