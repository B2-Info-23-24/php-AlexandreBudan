<?php

namespace Model;


use Entity\User;
use Entity\Address;
use Entity\Reservation;
use Entity\Car;
use Config\DataBase;
use Entity\Brand;
use Entity\Color;
use Entity\Favori;
use PDO;
use PDOException;

class UserModel
{

    public function createUser(User $user, Address $address)
    {
        try {
            $stmtUser = DataBase::connect()->prepare("INSERT INTO User (email, password, firstName, lastName, phone, age, gender, addressId, creationDate, newsLetter, verified, isAdmin, status) 
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
                $addressId = AddressModel::createAddress($address);
                $stmtUser->bindParam(":addressId", $addressId);
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

    public static function getOneUser(Int $id)
    {
        try {
            $query = "SELECT User.id, User.email, User.password, User.firstName, User.lastName, User.phone, User.age, User.gender,
                JSON_OBJECT('id', Address.id, 'address', Address.address, 'city', Address.city, 'code', Address.code, 'country', Address.country) AS address,
                (SELECT JSON_ARRAYAGG(JSON_OBJECT('id', Reservation.id, 'car', 
                    JSON_OBJECT('id', Car.id, 'name', Car.name, 'type', Car.type, 
                        'brand', JSON_OBJECT('id', Brand.id, 'name', Brand.name),
                        'color', JSON_OBJECT('id', Color.id, 'name', Color.name)),
                        'price', Reservation.price, 'beginning', Reservation.beginning, 'ending', Reservation.ending, 'finish', Reservation.finish)) 
                FROM Reservation 
                LEFT JOIN Car ON Reservation.carId = Car.id
                LEFT JOIN Brand ON Car.brandId = Brand.id
                LEFT JOIN Color ON Car.colorId = Color.id
                WHERE User.id = Reservation.userId
            ) AS reservations,
            (SELECT JSON_ARRAYAGG(JSON_OBJECT('id', Favori.id,
                    'car', JSON_OBJECT('id', Car.id, 'name', Car.name, 'type', Car.type,
                        'brand', JSON_OBJECT('id', Brand.id, 'name', Brand.name),
                        'color', JSON_OBJECT('id', Color.id, 'name', Color.name),
                        'price', Car.price, 'manual', Car.manual, 'minAge', Car.minAge, 'nbDoor', Car.nbDoor))) 
                FROM Favori 
                LEFT JOIN Car ON Favori.carId = Car.id
                LEFT JOIN Brand ON Car.brandId = Brand.id
                LEFT JOIN Color ON Car.colorId = Color.id
                WHERE User.id = Favori.userId
            ) AS favoris, 
            User.creationDate, User.newsLetter, User.verified, User.isAdmin, User.status
            FROM User
            JOIN Address ON User.addressId = Address.id
            WHERE User.id = $id;";

            $stmt = DataBase::connect()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $result['address'] = json_decode($result['address']);
            $result['reservations'] = json_decode($result['reservations'], true);
            $result['favoris'] = json_decode($result['favoris'], true);

            $result['address'] = new Address(...get_object_vars($result['address']));

            for ($i = 0; $i < sizeof($result['reservations']); $i++) {
                $result['reservations'][$i]['car']['brand'] = new Brand(...$result['reservations'][$i]['car']['brand']);
                $result['reservations'][$i]['car']['color'] = new Color(...$result['reservations'][$i]['car']['color']);
                $result['reservations'][$i]['car'] = new Car(...$result['reservations'][$i]['car']);
                $result['reservations'][$i] = new Reservation(...$result['reservations'][$i]);
            }

            for ($i = 0; $i < sizeof($result['favoris']); $i++) {
                $result['favoris'][$i]['car']['brand'] = new Brand(...$result['favoris'][$i]['car']['brand']);
                $result['favoris'][$i]['car']['color'] = new Color(...$result['favoris'][$i]['car']['color']);
                $result['favoris'][$i]['car'] = new Car(...$result['favoris'][$i]['car']);
                $result['favoris'][$i] = new Favori(...$result['favoris'][$i]);
            }

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function checkLogin(String $email, String $password)
    {
        try {
            $stmt = DataBase::connect()->prepare("SELECT id, email, password FROM User WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $result['password'])) {
                return $result['id'];
            } else {
                return false;
            }
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
