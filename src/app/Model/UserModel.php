<?php

namespace Model;

use Entity\User;
use Entity\Address;
use Config\DataBase;

class UserModel
{

    private $conn;

    public function __construct()
    {
        $this->conn = DataBase::connect();
    }
}
