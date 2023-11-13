<?php

class Passenger
{
    // Propriétés
    public $id;
    public $number;

    // Méthode constructeur
    public function __construct($id, $number)
    {
        $this->id = $id;
        $this->number = $number;
    }
}
