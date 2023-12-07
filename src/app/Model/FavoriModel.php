<?php

namespace Model;

use PDOException;
use Entity\Favori;
use Config\DataBase;
use Entity\Car;
use Entity\User;
use PDO;

class FavoriModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createFavori(Favori $favori)
    {
        try {
            $userId = $favori->getUser()->getId();
            $carId = $favori->getCar()->getId();

            $stmtFavori = self::$conn->prepare("INSERT INTO Favori (userId, carId, status) 
                                            VALUES (:userId, :carId, 1)");

            $stmtFavori->bindParam(":userId", $userId);
            $stmtFavori->bindParam(":carId", $carId);

            $stmtFavori->execute();

            $favoriId = self::$conn->query("SELECT MAX(id) FROM Favori")->fetchColumn();

            return $favoriId;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllFavoriOfUser(int $userId)
    {
        try {
            $stmtFavori = self::$conn->prepare("SELECT 'id', Favori.id,
                                                    'car', JSON_OBJECT('id', Car.id) AS car,
                                                    'user', JSON_OBJECT('id', User.id) AS user
                                                FROM Favori 
                                                LEFT JOIN Car ON Favori.carId = Car.id
                                                LEFT JOIN User ON Favori.userId = User.id
                                                WHERE Favori.userId = :userId");
            $stmtFavori->bindParam(":userId", $userId);
            $stmtFavori->execute();

            $favoris = $stmtFavori->fetchAll(PDO::FETCH_ASSOC);

            $favoriList = [];

            foreach ($favoris as $favori) {
                $favori['car'] = new Car(...get_object_vars(json_decode($favori['car'])));
                $favori['user'] = new User(...get_object_vars(json_decode($favori['user'])));
                $favori = new Favori(...$favori);

                array_push($favoriList, $favori);
            }

            return $favoriList;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteFavori(User $user, int $carId)
    {
        $userId = $user->getId();
        try {
            $stmtFavori = self::$conn->prepare("DELETE FROM Favori WHERE userId = :userId AND carId = :carId");
            $stmtFavori->bindParam(":userId", $userId);
            $stmtFavori->bindParam(":carId", $carId);

            $stmtFavori->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
