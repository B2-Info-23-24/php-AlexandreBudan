<?php

namespace Model;

use Entity\Color;
use Config\DataBase;
use PDO;
use PDOException;

class ColorModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createColor(string $colorName)
    {
        try {

            $stmtColor = self::$conn->prepare("INSERT INTO Color (colorName) VALUES (:colorName)");
            $stmtColor->bindParam(":colorName", $colorName);

            $stmtColor->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOneColor($id)
    {
        try {
            $stmtColor = self::$conn->query("SELECT * FROM Color WHERE id = $id");

            $result = $stmtColor->fetch(PDO::FETCH_ASSOC);

            $color = new Color(...$result);

            return $color;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllColor()
    {
        try {
            $stmtColor = self::$conn->prepare("SELECT * FROM Color");
            $stmtColor->execute();

            $colors = $stmtColor->fetchAll();

            $colorList = [];

            foreach ($colors as $color) {
                $color = new Color($color['id'], $color['colorName']);
                array_push($colorList, $color);
            }

            return $colorList;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteColor($id)
    {
        try {
            $stmtColor = self::$conn->prepare("DELETE FROM Color WHERE id = :id");
            $stmtColor->bindParam(":id", $id);
            $stmtColor->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function checkCreate($colorName)
    {
        try {
            $stmtColor = self::$conn->prepare("SELECT * FROM Color WHERE colorName = :colorName");
            $stmtColor->bindParam(":colorName", $colorName);
            $stmtColor->execute();
            if ($stmtColor->rowCount() > 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
