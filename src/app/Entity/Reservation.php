<?php

namespace Entity;

class Reservation
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var Car car of the Reservation
     */
    private $car;

    /**
     * @var User user of the Reservation
     */
    private $user;

    /**
     * @var Pilote pilote of the Reservation
     */
    private $pilote;

    /**
     * @var string hash of the Reservation
     */
    private $hash;

    /**
     * @var bool protection of the Car
     */
    private $protection;

    /**
     * @var float price of the Reservation
     */
    private $price;

    /**
     * @var string date of the beginning of UnvailableDate
     */
    private $beginning;

    /**
     * @var string date of the ending of UnvailableDate
     */
    private $ending;

    /**
     * @var bool if the Reservation is finish or not
     */
    private $finish;

    /**
     * @var string State of the Car at the beginning
     */
    private $beginningState;

    /**
     * @var string State of the Car at the ending
     */
    private $endingState;

    /**
     * @var float price of the add fees
     */
    private $addFees;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor

    /**
     * Reservation constructor
     *
     * @param  int  $id  id Primary Key
     * @param  Car  $car  Car Foreign Key link Car
     * @param  User  $user  User Foreign Key link User
     * @param  Pilote  $pilote  Pilote Foreign Key link Pilote
     * @param  string  $hash  hash of the Reservation
     * @param  bool  $protection  protection of the Car
     * @param  float  $price  price of the Reservation
     * @param  string  $beginning  date of the beginning of UnvailableDate
     * @param  string  $ending  date of the ending of UnvailableDate
     * @param  bool  $finish  if the Reservation is finish or not
     * @param  string  $beginningState  State of the Car at the beginning
     * @param  string  $endingState  State of the Car at the ending
     * @param  float  $addFees  price of the add fees
     *
     * @return  void
     */
    public function __construct(int $id, Car $car = null, User $user = null, Pilote $pilote = null, string $hash, bool $protection = null, float $price = null, string $beginning = null, string $ending = null, bool $finish = null, string $beginningState = null, string $endingState = null, float $addFees = null)
    {
        $this->id = $id;
        $this->car = $car;
        $this->user = $user;
        $this->pilote = $pilote;
        $this->hash = $hash;
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
     * Get car of the Reservation
     *
     * @return  Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set car of the Reservation
     *
     * @param  Car  $car car of the Reservation
     *
     * @return  self
     */
    public function setCar(Car $car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get user of the Reservation
     *
     * @return  User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user of the Reservation
     *
     * @param  user  $user user of the Reservation
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get protection of the Car
     *
     * @return  bool
     */
    public function getProtection()
    {
        return $this->protection;
    }

    /**
     * Set protection of the Car
     *
     * @param  bool  $protection  protection of the Car
     *
     * @return  self
     */
    public function setProtection(bool $protection)
    {
        $this->protection = $protection;

        return $this;
    }

    /**
     * Get price of the Reservation
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price of the Reservation
     *
     * @param  float  $price  price of the Reservation
     *
     * @return  self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get date of the beginning of UnvailableDate
     *
     * @return  string
     */
    public function getBeginning()
    {
        return $this->beginning;
    }

    /**
     * Set date of the beginning of UnvailableDate
     *
     * @param  string  $beginning  date of the beginning of UnvailableDate
     *
     * @return  self
     */
    public function setBeginning(string $beginning)
    {
        $this->beginning = $beginning;

        return $this;
    }

    /**
     * Get date of the ending of UnvailableDate
     *
     * @return  string
     */
    public function getEnding()
    {
        return $this->ending;
    }

    /**
     * Set date of the ending of UnvailableDate
     *
     * @param  string  $ending  date of the ending of UnvailableDate
     *
     * @return  self
     */
    public function setEnding(string $ending)
    {
        $this->ending = $ending;

        return $this;
    }

    /**
     * Get if the Reservation is finish or not
     *
     * @return  bool
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * Set if the Reservation is finish or not
     *
     * @param  bool  $finish  if the Reservation is finish or not
     *
     * @return  self
     */
    public function setFinish(bool $finish)
    {
        $this->finish = $finish;

        return $this;
    }

    /**
     * Get state of the Car at the beginning
     *
     * @return  string
     */
    public function getBeginningState()
    {
        return $this->beginningState;
    }

    /**
     * Set state of the Car at the beginning
     *
     * @param  string  $beginningState  State of the Car at the beginning
     *
     * @return  self
     */
    public function setBeginningState(string $beginningState)
    {
        $this->beginningState = $beginningState;

        return $this;
    }

    /**
     * Get state of the Car at the ending
     *
     * @return  string
     */
    public function getEndingState()
    {
        return $this->endingState;
    }

    /**
     * Set state of the Car at the ending
     *
     * @param  string  $endingState  State of the Car at the ending
     *
     * @return  self
     */
    public function setEndingState(string $endingState)
    {
        $this->endingState = $endingState;

        return $this;
    }

    /**
     * Get price of the add fees
     *
     * @return  float
     */
    public function getAddFees()
    {
        return $this->addFees;
    }

    /**
     * Set price of the add fees
     *
     * @param  float  $addFees  price of the add fees
     *
     * @return  self
     */
    public function setAddFees(float $addFees)
    {
        $this->addFees = $addFees;

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
     * Get the value of hash
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set the value of hash
     *
     * @return  self
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get the value of pilote
     */
    public function getPilote()
    {
        return $this->pilote;
    }

    /**
     * Set the value of pilote
     *
     * @return  self
     */
    public function setPilote($pilote)
    {
        $this->pilote = $pilote;

        return $this;
    }
}
