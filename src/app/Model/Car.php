<?php

class Car
{
    // Propriétés
    public $id;
    public $name;
    public $brandId;
    public $colorId;
    public $passengerId;
    public $price;
    public $manual;
    public $type;
    public $minAge;
    public $nbDoor;
    public $location;
    public $status;

    // Méthode constructeur
    public function __construct($id, $name, $brandId, $colorId, $passengerId, $price, $manual, $type, $minAge, $nbDoor, $location)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brandId = $brandId;
        $this->colorId = $colorId;
        $this->passengerId = $passengerId;
        $this->price = $price;
        $this->manual = $manual;
        $this->type = $type;
        $this->minAge = $minAge;
        $this->nbDoor = $nbDoor;
        $this->location = $location;
        $this->status = true;
    }
}
