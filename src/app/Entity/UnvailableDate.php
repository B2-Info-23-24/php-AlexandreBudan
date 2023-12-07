<?php

namespace Entity;

class UnvailableDate
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var int id Foreign Key link Car
     */
    private $carId;

    /**
     * @var string date of the beginning of UnvailableDate
     */
    private $beginning;

    /**
     * @var string date of the ending of UnvailableDate
     */
    private $ending;

    // Constructor

    /**
     * UnvailableDate constructor
     *
     * @param  int  $id  id Primary Key
     * @param  int  $carId  id Foreign Key link Car
     * @param  string  $beginning  date of the beginning of UnvailableDate
     * @param  string  $ending  date of the ending of UnvailableDate
     *
     * @return  void
     */
    public function __construct(int $id, int $carId = null, string $beginning = null, string $ending = null)
    {
        $this->id = $id;
        $this->carId = $carId;
        $this->beginning = $beginning;
        $this->ending = $ending;
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
}
