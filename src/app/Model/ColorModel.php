<?php

namespace Model;

use Entity\Color;
use Config\DataBase;
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
        } catch (PDOException $e) {
            return false;
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
        } catch (PDOException $e) {
            return false;
        }
    }
}
