<?php

class Brand
{
    // Propriétés
    public $id;
    public $name;

    // Méthode constructeur
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
