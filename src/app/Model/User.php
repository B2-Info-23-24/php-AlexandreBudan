<?php

class User
{
    // Propriétés
    public $id;
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;
    public $age;
    public $gender;
    public $addressId;
    public $creationDate;
    public $newsLetter;
    public $verified;
    public $isAdmin;
    public $status;

    // Méthode constructeur
    public function __construct($id, $email, $password, $firstName, $lastName, $phone, $age, $gender, $addressId, $newsLetter, $verified, $isAdmin)
    {
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');

        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->age = $age;
        $this->gender = $gender;
        $this->addressId = $addressId;
        $this->creationDate = $dateString;
        $this->newsLetter = $newsLetter;
        $this->verified = $verified;
        $this->isAdmin = $isAdmin;
        $this->status = true;
    }
}
