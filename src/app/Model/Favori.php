<?php

class Favori
{
    // Propriétés
    public $id;
    public $userId;
    public $carId;
    public $status;

    // Méthode constructeur
    public function __construct($id, $userId, $carId)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->carId = $carId;
        $this->status = true;
    }
}
