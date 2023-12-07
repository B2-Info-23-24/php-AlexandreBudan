<?php

namespace Entity;

use DateTime;

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
     * @var User user linked to the opinion
     */
    private $user;

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

    /**
     * Opinion constructor
     *
     * @param  int  $id  id Primary Key
     * @param  int  $carId  id Foreign Key link Car
     * @param  User  $user  user Foreign Key link User
     * @param  int  $reservationId  id Foreign Key link Reservation
     * @param  string  $commentary  comment about the reservation
     * @param  string  $rank  rank of the reservation
     *
     * @return  void
     */
    public function __construct(int $id, int $carId = null, User $user = null, int $reservationId = null, string $commentary = null, string $rank = null)
    {
        $date = new DateTime();
        $dateString = $date->format('Y-m-d H:i:s');

        $this->id = $id;
        $this->carId = $carId;
        $this->user = $user;
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

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of carId
     */
    public function getCarId()
    {
        return $this->carId;
    }

    /**
     * Set the value of carId
     *
     * @return  self
     */
    public function setCarId($carId)
    {
        $this->carId = $carId;

        return $this;
    }
}
