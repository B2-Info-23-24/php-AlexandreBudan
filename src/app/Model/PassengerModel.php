<?php

namespace Model;

use Entity\Passenger;
use Config\DataBase;

class PassengerModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::connect();
    }
}
