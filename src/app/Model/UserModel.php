<?php

namespace Model;

use Entity\User;
use Entity\Address;
use Config\DataBase;
use PDOException;

class UserModel
{

    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::connect();
    }

    public function createUser(User $user, Address $address)
    {
        try {
            $stmtUser = $this->conn->prepare("INSERT INTO User (email, password, firstName, lastName, phone, age, gender, addressId, creationDate, newsLetter, verified, isAdmin, status) 
                                            VALUES (:email, :password, :firstName, :lastName, :phone, :age, :gender, :addressId, :creationDate, 0, 0, 0, 1)");

            $stmtUser->bindParam(":email", $user->getEmail());
            $stmtUser->bindParam(":password", password_hash($user->getPassword(), PASSWORD_DEFAULT));
            $stmtUser->bindParam(":firstName", $user->getFirstName());
            $stmtUser->bindParam(":lastName", $user->getLastName());
            $stmtUser->bindParam(":phone", $user->getPhone());
            $stmtUser->bindParam(":age", $user->getAge());
            $stmtUser->bindParam(":gender", $user->getGender());
            $stmtUser->bindParam(":creationDate", $user->getCreationDate());

            if ($address != null) {
                $stmtUser->bindParam(":addressId", $user->getAddressId());
                $stmtAddress = $this->conn->prepare("INSERT INTO Address (address, city, code, country, status) 
                                            VALUES (:address, :city, :code, :country, 1)");
                $stmtAddress->bindParam(":address", $address->getAddress());
                $stmtAddress->bindParam(":city", $address->getCity());
                $stmtAddress->bindParam(":code", $address->getCode());
                $stmtAddress->bindParam(":country", $address->getCountry());

                $stmtAddress->execute();
            }

            $stmtUser->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllUsers()
    {
        try {
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUserbyId(Int $id)
    {
        try {
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateUser(Int $id)
    {
        try {
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteUser(Int $id)
    {
        try {
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
