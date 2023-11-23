<?php

namespace Model;

use Entity\Color;
use Config\DataBase;

class ColorModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::connect();
    }
}
