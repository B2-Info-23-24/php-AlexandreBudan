<?php

class Reservation
{
    // Propriétés
    public $id;
    public $carId;
    public $userId;
    public $protection;
    public $price;
    public $beginning;
    public $ending;
    public $finish;
    public $beginningState;
    public $endingState;
    public $addFees;
    public $status;

    // Méthode constructeur
    public function __construct($id, $carId, $userId, $protection, $price, $beginning, $ending, $finish, $beginningState, $endingState, $addFees)
    {
        $this->id = $id;
        $this->carId = $carId;
        $this->userId = $userId;
        $this->protection = $protection;
        $this->price = $price;
        $this->beginning = $beginning;
        $this->ending = $ending;
        $this->finish = $finish;
        $this->beginningState = $beginningState;
        $this->endingState = $endingState;
        $this->addFees = $addFees;
        $this->status = true;
    }
}
