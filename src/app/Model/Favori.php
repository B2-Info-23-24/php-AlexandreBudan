<?php

class Favori
{
    // Propriétés

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var int id Foreign Key link User
     */
    private $userId;

    /**
     * @var int id Foreign Key link Car
     */
    private $carId;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor
    public function __construct($id, $userId, $carId)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->carId = $carId;
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
     * Get id Foreign Key link User
     *
     * @return  int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set id Foreign Key link User
     *
     * @param  int  $userId  id Foreign Key link User
     *
     * @return  self
     */
    public function setUserId(int $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get id Foreign Key link Car
     *
     * @return  int
     */
    public function getCarId()
    {
        return $this->carId;
    }

    /**
     * Set id Foreign Key link Car
     *
     * @param  int  $carId  id Foreign Key link Car
     *
     * @return  self
     */
    public function setCarId(int $carId)
    {
        $this->carId = $carId;

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
