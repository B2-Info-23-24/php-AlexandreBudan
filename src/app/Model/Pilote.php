<?php

class Pilote
{
    // Propriétés
    public $id;
    public $reservationId;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $status;

    // Méthode constructeur
    public function __construct($id, $reservationId, $firstName, $lastName, $email, $phone)
    {
        $this->id = $id;
        $this->reservationId = $reservationId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->status = true;
    }
}
