<?php

namespace Model;

use Entity\Address;
use Config\DataBase;
use PDOException;

class AddressModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::connect();
    }

    public static function createAddress(Address $address)
    {
        try {
            $conn = self::getConn();

            $stmtAddress = $conn->prepare("INSERT INTO Address (address, city, code, country, status) 
                                            VALUES (:address, :city, :code, :country, 1)");
            $stmtAddress->bindParam(":address", $address->getAddress());
            $stmtAddress->bindParam(":city", $address->getCity());
            $stmtAddress->bindParam(":code", $address->getCode());
            $stmtAddress->bindParam(":country", $address->getCountry());

            $stmtAddress->execute();

            $addressid = $conn->query("SELECT MAX(id) FROM Address")->fetchColumn();

            return $addressid;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Get the value of conn
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * Set the value of conn
     *
     * @return  self
     */
    public function setConn($conn)
    {
        $this->conn = $conn;

        return $this;
    }
}
