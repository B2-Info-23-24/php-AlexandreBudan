<?php

namespace Model;

use Entity\Brand;
use Config\DataBase;
use PDOException;

class BrandModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }

    public function createBrand(string $brandName)
    {
        try {

            $stmtBrand = self::$conn->prepare("INSERT INTO Brand (brandName) VALUES (:brandName)");
            $stmtBrand->bindParam(":brandName", $brandName);

            $stmtBrand->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllBrand()
    {
        try {
            $stmtBrand = self::$conn->prepare("SELECT * FROM Brand");
            $stmtBrand->execute();

            $brands = $stmtBrand->fetchAll();

            $brandList = [];

            foreach ($brands as $brand) {
                $brand = new Brand($brand['id'], $brand['brandName']);
                array_push($brandList, $brand);
            }

            return $brandList;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteBrand($id)
    {
        try {
            $stmtBrand = self::$conn->prepare("DELETE FROM Brand WHERE id = :id");
            $stmtBrand->bindParam(":id", $id);
            $stmtBrand->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
