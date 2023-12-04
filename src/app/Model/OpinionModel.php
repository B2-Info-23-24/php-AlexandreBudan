<?php

namespace Model;

use Config\DataBase;
use Entity\Opinion;
use Entity\User;
use PDO;
use PDOException;

class OpinionModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createOpinion(Opinion $opinion)
    {
        try {
            $stmtOpinion = self::$conn->prepare("INSERT INTO Opinion (carId, userId, reservationId, commentary, rank)
                                    VALUES (:carId, :userId, :reservationId, :commentary, :rank)");
            $stmtOpinion->bindParam(":carId", $opinion->getCarId());
            $stmtOpinion->bindParam(":userId", $opinion->getUser()->getId());
            $stmtOpinion->bindParam(":reservationId", $opinion->getReservationId());
            $stmtOpinion->bindParam(":commentary", $opinion->getCommentary());
            $stmtOpinion->bindParam(":rank", $opinion->getRank());
            $stmtOpinion->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOpinionsByCarId($id)
    {
        try {
            $stmtOpinion = self::$conn->prepare("SELECT Opinion.id, Opinion.carId,
                                    (SELECT JSON_OBJECT('id', User.id, 'email', User.email)
                                        FROM User
                                        WHERE User.id = Opinion.userId
                                    ) AS user,
                                    Opinion.reservationId, Opinion.commentary, Opinion.rank
                                    FROM Opinion
                                    WHERE Opinion.carId = :id");
            $stmtOpinion->bindParam(":id", $id);
            $stmtOpinion->execute();

            $opinions = $stmtOpinion->fetchAll(PDO::FETCH_ASSOC);

            $opinionsList = [];

            foreach ($opinions as $opinion) {
                $opinion['user'] = new User(...get_object_vars(json_decode($opinion['user'])));
                $opinionsList[] = new Opinion(...$opinion);
            }

            return $opinionsList;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteOpinion(int $id)
    {
        try {
            $stmtOpinion = self::$conn->prepare("DELETE FROM Opinion WHERE id = :id");
            $stmtOpinion->bindParam(":id", $id);
            $stmtOpinion->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
