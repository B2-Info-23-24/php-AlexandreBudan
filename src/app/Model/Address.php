<?php

class Address
{
    // Propriétés
    public $id;
    public $address;
    public $city;
    public $code;
    public $country;
    public $status;

    // Méthode constructeur
    public function __construct($id, $address, $city, $code, $country)
    {
        $this->id = $id;
        $this->address = $address;
        $this->city = $city;
        $this->code = $code;
        $this->country = $country;
        $this->status = true;
    }
}
