<?php

class Opinion
{
    // Propriétés
    public $id;
    public $carId;
    public $userId;
    public $reservationId;
    public $commentary;
    public $rank;
    public $creationDate;
    public $status;

    // Méthode constructeur
    public function __construct($id, $carId, $userId, $reservationId, $commentary, $rank)
    {
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');

        $this->id = $id;
        $this->carId = $carId;
        $this->userId = $userId;
        $this->reservationId = $reservationId;
        $this->commentary = $commentary;
        $this->rank = $rank;
        $this->creationDate = $dateString;
        $this->status = true;
    }
}
