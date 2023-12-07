<?php

namespace Entity;

class Car
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var string name of the Car
     */
    private $name;

    /**
     * @var Brand brand of the Car
     */
    private $brand;

    /**
     * @var Color color of the Car
     */
    private $color;

    /**
     * @var Passenger number of passenger of the car
     */
    private $passenger;

    /**
     * @var string url of picture of the car
     */
    private $picture;

    /**
     * @var float price of the Car por Day
     */
    private $price;

    /**
     * @var bool true -> manual, false -> automatic
     */
    private $manual;

    /**
     * @var string type of the Car
     */
    private $type;

    /**
     * @var int minimum Age to reserve the Car
     */
    private $minAge;

    /**
     * @var int numbers of Door
     */
    private $nbDoor;

    /**
     * @var string position of the Car
     */
    private $location;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor

    /**
     * Car constructor
     *
     * @param  int  $id  id Primary Key
     * @param  string  $name  name of the Car
     * @param  Brand  $brand  Brand of the Car
     * @param  Color  $color  Color of the Car
     * @param  Passenger  $passenger  number of Passenger of the Car
     * @param  string  $picture  picture of the Car
     * @param  float  $price  price of the Car por Day
     * @param  bool  $manual  true -> manual, false -> automatic
     * @param  string  $type  type of the Car
     * @param  int  $minAge  minimum Age to reserve the Car
     * @param  int  $nbDoor  numbers of Door
     * @param  string  $location  position of the Car
     *
     * @return  void
     */
    public function __construct(int $id, string $name = null, Brand $brand = null, Color $color = null, Passenger $passenger = null, string $picture = null, float $price = null, bool $manual = null, string $type = null, int $minAge = null, int $nbDoor = null, string $location = null, bool $status = true)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->color = $color;
        $this->passenger = $passenger;
        $this->picture = $picture;
        $this->price = $price;
        $this->manual = $manual;
        $this->type = $type;
        $this->minAge = $minAge;
        $this->nbDoor = $nbDoor;
        $this->location = $location;
        $this->status = $status;
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
     * Get name of the Car
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name of the Car
     *
     * @param  string  $name  name of the Car
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Brand of the Car
     *
     * @return  Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set Brand of the Car
     *
     * @param  Brand $brand brand of the Car
     *
     * @return  self
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get Color of the Car
     *
     * @return  Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set Color of the Car
     *
     * @param  Color  $color color of the Car
     *
     * @return  self
     */
    public function setColor(Color $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get number of Passenger of the Car
     *
     * @return  Passenger
     */
    public function getPassenger()
    {
        return $this->passenger;
    }

    /**
     * Set number of Passenger of the Car
     *
     * @param  Passenger  $passenger  number of Passenger of the Car
     *
     * @return  self
     */
    public function setPassenger(Passenger $passenger)
    {
        $this->passenger = $passenger;

        return $this;
    }

    /**
     * Get price of the Car por Day
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price of the Car por Day
     *
     * @param  float  $price  price of the Car por Day
     *
     * @return  self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get true -> manual, false -> automatic
     *
     * @return  bool
     */
    public function getManual()
    {
        return $this->manual;
    }

    /**
     * Set true -> manual, false -> automatic
     *
     * @param  bool  $manual  true -> manual, false -> automatic
     *
     * @return  self
     */
    public function setManual(bool $manual)
    {
        $this->manual = $manual;

        return $this;
    }

    /**
     * Get type of the Car
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type of the Car
     *
     * @param  string  $type  type of the Car
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get minimum Age to reserve the Car
     *
     * @return  int
     */
    public function getMinAge()
    {
        return $this->minAge;
    }

    /**
     * Set minimum Age to reserve the Car
     *
     * @param  int  $minAge  minimum Age to reserve the Car
     *
     * @return  self
     */
    public function setMinAge(int $minAge)
    {
        $this->minAge = $minAge;

        return $this;
    }

    /**
     * Get numbers of Door
     *
     * @return  int
     */
    public function getNbDoor()
    {
        return $this->nbDoor;
    }

    /**
     * Set numbers of Door
     *
     * @param  int  $nbDoor  numbers of Door
     *
     * @return  self
     */
    public function setNbDoor(int $nbDoor)
    {
        $this->nbDoor = $nbDoor;

        return $this;
    }

    /**
     * Get position of the Car
     *
     * @return  string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set position of the Car
     *
     * @param  string  $location  position of the Car
     *
     * @return  self
     */
    public function setLocation(string $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get status for Data Management
     *
     * @return  bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status for Data Management
     *
     * @param  bool  $status  status for Data Management
     *
     * @return  self
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }
}
