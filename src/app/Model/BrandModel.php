<?php

namespace Model;

use Entity\Brand;
use Config\DataBase;

class BrandModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::connect();
    }
}
