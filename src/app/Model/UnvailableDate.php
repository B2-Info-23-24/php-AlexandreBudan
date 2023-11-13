<?php

class UnvailableDate
{
    // Propriétés
    public $id;
    public $carId;
    public $beginning;
    public $ending;

    // Méthode constructeur
    public function __construct($id, $carId, $beginning, $ending)
    {
        $this->id = $id;
        $this->carId = $carId;
        $this->beginning = $beginning;
        $this->ending = $ending;
    }
}
