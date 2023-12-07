<?php

namespace Model;

use Config\DataBase;
use PDO;
use PDOException;
use Entity\User;
use Entity\Address;
use Entity\Reservation;
use Entity\Car;
use Entity\Brand;
use Entity\Color;
use Entity\Favori;
use Entity\Opinion;

class UserModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createUser(User $user)
    {
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $phone = $user->getPhone();
        $age = $user->getAge();
        $gender = $user->getGender();
        $creationDate = $user->getCreationDate();
        $address = $user->getAddress();
        $isAdmin = $user->getIsAdmin() ? 1 : 0;

        try {
            $stmtUser = self::$conn->prepare("INSERT INTO User (email, password, firstName, lastName, phone, age, gender, addressId, creationDate, newsLetter, verified, isAdmin, status) 
                                            VALUES (:email, :password, :firstName, :lastName, :phone, :age, :gender, :addressId, :creationDate, 0, 0, :isAdmin, 1)");

            $stmtUser->bindParam(":email", $email);
            $stmtUser->bindParam(":password", $password);
            $stmtUser->bindParam(":firstName", $firstName);
            $stmtUser->bindParam(":lastName", $lastName);
            $stmtUser->bindParam(":phone", $phone);
            $stmtUser->bindParam(":age", $age);
            $stmtUser->bindParam(":gender", $gender);
            $stmtUser->bindParam(":creationDate", $creationDate);
            $stmtUser->bindParam(":isAdmin", $isAdmin);

            if ($address != null) {
                $initAddress = new AddressModel();
                $addressId = $initAddress->createAddress($address);
                $address->setId($addressId);
                $user->setAddress($address);
                $stmtUser->bindParam(":addressId", $addressId);
            }

            $stmtUser->execute();

            $user->setId(self::$conn->query("SELECT MAX(id) FROM User")->fetchColumn());

            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllUser()
    {
        try {
            $query = "SELECT User.id, User.email, User.status FROM User ORDER BY User.email ASC";

            $stmt = self::$conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $userList = [];

            foreach ($result as $user) {
                $user = new User(...$user);
                array_push($userList, $user);
            }

            return $userList;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOneUser(Int $id)
    {
        try {
            $query = "SELECT User.id, User.email, User.password, User.firstName, User.lastName, User.phone, User.age, User.gender,
                JSON_OBJECT('id', Address.id, 'address', Address.address, 'city', Address.city, 'code', Address.code, 'country', Address.country) AS address,
                (SELECT JSON_ARRAYAGG(JSON_OBJECT('id', Reservation.id, 'car',
                    JSON_OBJECT('id', Car.id, 'name', Car.name, 'type', Car.type, 
                        'brand', JSON_OBJECT('id', Brand.id, 'brandName', Brand.brandName),
                        'color', JSON_OBJECT('id', Color.id, 'colorName', Color.colorName), 'picture', Car.picture),
                        'user', null, 'pilote', null, 'hash', Reservation.hash, 'protection', Reservation.protection, 'price', Reservation.price, 'beginning', Reservation.beginning, 'ending', Reservation.ending, 'finish', Reservation.finish)) 
                FROM Reservation 
                LEFT JOIN Car ON Reservation.carId = Car.id
                LEFT JOIN Brand ON Car.brandId = Brand.id
                LEFT JOIN Color ON Car.colorId = Color.id
                WHERE User.id = Reservation.userId
            ) AS reservations,
            (SELECT JSON_ARRAYAGG(JSON_OBJECT('id', Favori.id,
                    'car', JSON_OBJECT('id', Car.id, 'name', Car.name, 'type', Car.type,
                        'brand', JSON_OBJECT('id', Brand.id, 'brandName', Brand.brandName),
                        'color', JSON_OBJECT('id', Color.id, 'colorName', Color.colorName),
                        'picture', Car.picture, 'price', Car.price, 'manual', Car.manual, 'minAge', Car.minAge, 'nbDoor', Car.nbDoor))) 
                FROM Favori 
                LEFT JOIN Car ON Favori.carId = Car.id
                LEFT JOIN Brand ON Car.brandId = Brand.id
                LEFT JOIN Color ON Car.colorId = Color.id
                WHERE User.id = Favori.userId
            ) AS favoris,
            (SELECT JSON_ARRAYAGG(JSON_OBJECT('id', Opinion.id,
                    'carId', Opinion.carId,
                    'reservationId', Opinion.reservationId,
                    'commentary', Opinion.commentary, 'rank', Opinion.rank))
                FROM Opinion
                WHERE User.id = Opinion.userId
            ) AS opinions,
            User.creationDate, User.newsLetter, User.verified, User.isAdmin, User.status
            FROM User
            JOIN Address ON User.addressId = Address.id
            WHERE User.id = $id;";

            $stmt = self::$conn->prepare($query);
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
            } else {
                $result['reservations'] = [];
            }

            if ($result['favoris'] != null) {
                $result['favoris'] = json_decode($result['favoris'], true);

                for ($i = 0; $i < sizeof($result['favoris']); $i++) {
                    $result['favoris'][$i]['car']['brand'] = new Brand(...$result['favoris'][$i]['car']['brand']);
                    $result['favoris'][$i]['car']['color'] = new Color(...$result['favoris'][$i]['car']['color']);
                    $result['favoris'][$i]['car'] = new Car(...$result['favoris'][$i]['car']);
                    $result['favoris'][$i] = new Favori(...$result['favoris'][$i]);
                }
            } else {
                $result['favoris'] = [];
            }

            if ($result['opinions'] != null) {
                $result['opinions'] = json_decode($result['opinions'], true);

                for ($i = 0; $i < sizeof($result['opinions']); $i++) {
                    $result['opinions'][$i] = new Opinion(...$result['opinions'][$i]);
                }
            } else {
                $result['opinions'] = [];
            }

            array_pop($result);
            $result = new User(...$result);

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkLogin(String $email, String $password)
    {
        try {
            $stmt = self::$conn->prepare("SELECT id, email, password, status FROM User WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['status'] != 0) {
                if ($result != false && password_verify($password, $result['password'])) {
                    return $result['id'];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkRegister(String $email)
    {
        try {
            $stmt = self::$conn->prepare("SELECT EXISTS(SELECT * from User WHERE email = :email) AS count;");
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

    public function updateUser(Int $id, Int $index, array $list)
    {
        try {
            switch ($index) {
                case 1:
                    $firstName = $list[0];
                    $lastName = $list[1];
                    $stmt = self::$conn->prepare("UPDATE User SET firstName = :firstName, lastName = :lastName WHERE id = $id");
                    $stmt->bindParam(":firstName", $firstName);
                    $stmt->bindParam(":lastName", $lastName);
                    $stmt->execute();
                    $_SESSION['user']->setFirstName($firstName);
                    $_SESSION['user']->setLastName($lastName);
                    break;
                case 2:
                    $password = $list[0];
                    $newPassword = password_hash($list[1], PASSWORD_DEFAULT);
                    if (password_verify($password, $_SESSION['user']->getPassword())) {
                        $stmt = self::$conn->prepare("UPDATE User SET password = :password WHERE id = $id");
                        $stmt->bindParam(":password", $newPassword);
                        $stmt->execute();
                        $_SESSION['user']->setPassword($newPassword);
                    } else {
                        return "error";
                    }
                    break;
                case 3:
                    $address = $list[0];
                    $city = $list[1];
                    $code = $list[2];
                    $country = $list[3];
                    $stmt = self::$conn->prepare("UPDATE Address SET address = :address, city = :city, code = :code, country = :country WHERE id = $id");
                    $stmt->bindParam(":address", $address);
                    $stmt->bindParam(":city", $city);
                    $stmt->bindParam(":code", $code);
                    $stmt->bindParam(":country", $country);
                    $stmt->execute();
                    $_SESSION['user']->getAddress()->setAddress($address);
                    $_SESSION['user']->getAddress()->setCity($city);
                    $_SESSION['user']->getAddress()->setCode($code);
                    $_SESSION['user']->getAddress()->setCountry($country);
                    break;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteUser(Int $id)
    {
        try {
            $stmt = self::$conn->prepare("UPDATE User SET status = 0 WHERE id = $id");
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function unDeleteUser(Int $id)
    {
        try {
            $stmt = self::$conn->prepare("UPDATE User SET status = 1 WHERE id = $id");
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function removeUser(Int $id)
    {
        try {
            $stmt = self::$conn->prepare("DELETE FROM User WHERE id = $id");
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
