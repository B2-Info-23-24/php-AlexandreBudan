<?php

class Passenger
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var int number of Passenger
     */
    private $number;

    // Constructor
    public function __construct($id, $number)
    {
        $this->id = $id;
        $this->number = $number;
    }

    /**
     * Get id Primary Key
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id Primary Key
     *
     * @param  int  $id  id Primary Key
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get number of Passenger
     *
     * @return  int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set number of Passenger
     *
     * @param  int  $number  number of Passenger
     *
     * @return  self
     */
    public function setNumber(int $number)
    {
        $this->number = $number;

        return $this;
    }
}
