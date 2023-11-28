<?php

namespace Model;

use Entity\Car;
use Config\DataBase;

class CarModel
{
    private static $conn;

    public function __construct()
    {
        $conn = new DataBase();
        self::$conn = $conn->connect();
    }
}
