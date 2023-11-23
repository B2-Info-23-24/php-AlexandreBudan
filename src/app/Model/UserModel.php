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

    public function createUser(User $user)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO User (email, password, firstName, lastName, phone, age, gender, addressId, creationDate, newsLetter, verified, isAdmin, status) 
                                            VALUES (:email, :password, :firstName, :lastName, :phone, :age, :gender, :addressId, :creationDate, 0, 0, 0, 1)");

            $stmt->bindParam(":email", $user->getEmail());
            $stmt->bindParam(":password", password_hash($user->getPassword(), PASSWORD_DEFAULT));
            $stmt->bindParam(":firstName", $user->getFirstName());
            $stmt->bindParam(":lastName", $user->getLastName());
            $stmt->bindParam(":phone", $user->getPhone());
            $stmt->bindParam(":age", $user->getAge());
            $stmt->bindParam(":gender", $user->getGender());
            $stmt->bindParam(":addressId", $user->getAddressId());
            $stmt->bindParam(":creationDate", $user->getCreationDate());

            $stmt->execute();
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
