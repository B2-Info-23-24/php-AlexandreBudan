<?php

namespace Entity;

class Favori
{
    // Propriétés

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var User User of the Favori
     */
    private $user;

    /**
     * @var Car Car of the Favori
     */
    private $car;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor

    /**
     * Favori constructor
     *
     * @param  int  $id  id Primary Key
     * @param  User  $user  User of the Favori
     * @param  Car  $car  Car of the Favori
     *
     * @return  void
     */
    public function __construct(int $id, user $user = null, Car $car = null)
    {
        $this->id = $id;
        $this->user = $user;
        $this->car = $car;
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
     * Get User of the Favori
     *
     * @return  User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set User of the Favori
     *
     * @param  User  $user  User of the Favori
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get Car of the Favori
     *
     * @return  Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set Car of the Favori
     *
     * @param  Car  $car  Car of the Favori
     *
     * @return  self
     */
    public function setCar(Car $car)
    {
        $this->car = $car;

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
}
