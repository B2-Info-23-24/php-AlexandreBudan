<?php

namespace Model;

use Entity\Address;
use Config\DataBase;
use PDOException;

class AddressModel
{
    public static function createAddress(Address $address)
    {
        try {
            $addressAdd = $address->getAddress();
            $city = $address->getCity();
            $code = $address->getCode();
            $country = $address->getCountry();

            $stmtAddress = DataBase::connect()->prepare("INSERT INTO Address (address, city, code, country, status) 
                                            VALUES (:address, :city, :code, :country, 1)");
            $stmtAddress->bindParam(":address", $addressAdd);
            $stmtAddress->bindParam(":city", $city);
            $stmtAddress->bindParam(":code", $code);
            $stmtAddress->bindParam(":country", $country);

            $stmtAddress->execute();

            $addressid = DataBase::connect()->query("SELECT MAX(id) FROM Address")->fetchColumn();

            return $addressid;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
