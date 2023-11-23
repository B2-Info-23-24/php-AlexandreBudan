<?php

namespace Model;

use Entity\Car;
use Config\DataBase;

class CarModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::connect();
    }
}
