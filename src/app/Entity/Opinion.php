<?php

class Opinion
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
     * @var int id Foreign Key link User
     */
    private $userId;

    /**
     * @var int id Foreign Key link Reservation
     */
    private $reservationId;

    /**
     * @var string comment about the reservation
     */
    private $commentary;

    /**
     * @var int rank of the reservation
     */
    private $rank;

    /**
     * @var string creation date of the Opinion
     */
    private $creationDate;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor
    public function __construct(int $id, int $carId, int $userId, int $reservationId, string $commentary, string $rank)
    {
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');

        $this->id = $id;
        $this->carId = $carId;
        $this->userId = $userId;
        $this->reservationId = $reservationId;
        $this->commentary = $commentary;
        $this->rank = $rank;
        $this->creationDate = $dateString;
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
     * Get id Foreign Key link Reservation
     *
     * @return  int
     */
    public function getReservationId()
    {
        return $this->reservationId;
    }

    /**
     * Set id Foreign Key link Reservation
     *
     * @param  int  $reservationId  id Foreign Key link Reservation
     *
     * @return  self
     */
    public function setReservationId(int $reservationId)
    {
        $this->reservationId = $reservationId;

        return $this;
    }

    /**
     * Get comment about the reservation
     *
     * @return  string
     */
    public function getCommentary()
    {
        return $this->commentary;
    }

    /**
     * Set comment about the reservation
     *
     * @param  string  $commentary  comment about the reservation
     *
     * @return  self
     */
    public function setCommentary(string $commentary)
    {
        $this->commentary = $commentary;

        return $this;
    }

    /**
     * Get rank of the reservation
     *
     * @return  int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set rank of the reservation
     *
     * @param  int  $rank  rank of the reservation
     *
     * @return  self
     */
    public function setRank(int $rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get creation date of the Opinion
     *
     * @return  string
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set creation date of the Opinion
     *
     * @param  string  $creationDate  creation date of the Opinion
     *
     * @return  self
     */
    public function setCreationDate(string $creationDate)
    {
        $this->creationDate = $creationDate;

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
