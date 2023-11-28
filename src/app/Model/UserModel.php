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

    public static function createUser(User $user, Address $address)
    {
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $phone = $user->getPhone();
        $age = $user->getAge();
        $gender = $user->getGender();
        $creationDate = $user->getCreationDate();

        try {
            $stmtUser = DataBase::connect()->prepare("INSERT INTO User (email, password, firstName, lastName, phone, age, gender, addressId, creationDate, newsLetter, verified, isAdmin, status) 
                                            VALUES (:email, :password, :firstName, :lastName, :phone, :age, :gender, :addressId, :creationDate, 0, 0, 0, 1)");

            $stmtUser->bindParam(":email", $email);
            $stmtUser->bindParam(":password", $password);
            $stmtUser->bindParam(":firstName", $firstName);
            $stmtUser->bindParam(":lastName", $lastName);
            $stmtUser->bindParam(":phone", $phone);
            $stmtUser->bindParam(":age", $age);
            $stmtUser->bindParam(":gender", $gender);
            $stmtUser->bindParam(":creationDate", $creationDate);

            if ($address != null) {
                $addressId = AddressModel::createAddress($address);
                $address->setId($addressId);
                $user->setAddress($address);
                $stmtUser->bindParam(":addressId", $addressId);
            }

            $stmtUser->execute();

            return $user;
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

            $result['address'] = new Address(...get_object_vars($result['address']));

            if ($result['reservations'] != null) {
                $result['reservations'] = json_decode($result['reservations'], true);

                for ($i = 0; $i < sizeof($result['reservations']); $i++) {
                    $result['reservations'][$i]['car']['brand'] = new Brand(...$result['reservations'][$i]['car']['brand']);
                    $result['reservations'][$i]['car']['color'] = new Color(...$result['reservations'][$i]['car']['color']);
                    $result['reservations'][$i]['car'] = new Car(...$result['reservations'][$i]['car']);
                    $result['reservations'][$i] = new Reservation(...$result['reservations'][$i]);
                }
            }

            if ($result['favoris'] != null) {
                $result['favoris'] = json_decode($result['favoris'], true);

                for ($i = 0; $i < sizeof($result['favoris']); $i++) {
                    $result['favoris'][$i]['car']['brand'] = new Brand(...$result['favoris'][$i]['car']['brand']);
                    $result['favoris'][$i]['car']['color'] = new Color(...$result['favoris'][$i]['car']['color']);
                    $result['favoris'][$i]['car'] = new Car(...$result['favoris'][$i]['car']);
                    $result['favoris'][$i] = new Favori(...$result['favoris'][$i]);
                }
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

    public static function checkRegister(String $email)
    {
        try {
            $stmt = DataBase::connect()->prepare("SELECT EXISTS(SELECT * from User WHERE email = :email) AS count;");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updateUser(Int $id, Int $index, array $list)
    {
        try {
            switch ($index) {
                case 1:
                    $firstName = $list[0];
                    $lastName = $list[1];
                    $stmt = DataBase::connect()->prepare("UPDATE User SET firstName = :firstName, lastName = :lastName WHERE id = $id");
                    $stmt->bindParam(":firstName", $firstName);
                    $stmt->bindParam(":lastName", $lastName);
                    $stmt->execute();
                    $_SESSION['user']['firstName'] = $firstName;
                    $_SESSION['user']['lastName'] = $lastName;
                    break;
                case 2:
                    $password = $list[0];
                    $newPassword = password_hash($list[1], PASSWORD_DEFAULT);
                    if (password_verify($password, $_SESSION['user']['password'])) {
                        $stmt = DataBase::connect()->prepare("UPDATE User SET password = :password WHERE id = $id");
                        $stmt->bindParam(":password", $newPassword);
                        $stmt->execute();
                        $_SESSION['user']['password'] = $newPassword;
                    } else {
                        return "error";
                    }
                    break;
                case 3:
                    $address = $list[0];
                    $city = $list[1];
                    $code = $list[2];
                    $country = $list[3];
                    $stmt = DataBase::connect()->prepare("UPDATE Address SET address = :address, city = :city, code = :code, country = :country WHERE id = $id");
                    $stmt->bindParam(":address", $address);
                    $stmt->bindParam(":city", $city);
                    $stmt->bindParam(":code", $code);
                    $stmt->bindParam(":country", $country);
                    $stmt->execute();
                    $_SESSION['user']['address']->setAddress($address);
                    $_SESSION['user']['address']->setCity($city);
                    $_SESSION['user']['address']->setCode($code);
                    $_SESSION['user']['address']->setCountry($country);
                    break;
            }
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
