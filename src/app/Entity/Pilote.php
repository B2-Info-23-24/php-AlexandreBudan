<?php

namespace Entity;

class Pilote
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var int id Foreign Key link Reservation
     */
    private $reservationId;

    /**
     * @var string firstName of the Pilote
     */
    private $firstName;

    /**
     * @var string lastName of the Pilote
     */
    private $lastName;

    /**
     * @var int age of the Pilote
     */
    private $age;

    /**
     * @var string email of the Pilote
     */
    private $email;

    /**
     * @var string phone of the Pilote
     */
    private $phone;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor

    /**
     * Pilote constructor
     *
     * @param  int  $id  id Primary Key
     * @param  int  $reservationId  id Foreign Key link Reservation
     * @param  string  $firstName  firstName of the Pilote
     * @param  string  $lastName  lastName of the Pilote
     * @param  int  $age  age of the Pilote
     * @param  string  $email  email of the Pilote
     * @param  string  $phone  phone of the Pilote
     *
     * @return  void
     */
    public function __construct(int $id, int $reservationId = null, string $firstName = null, string $lastName = null, int $age = null, string $email = null, string $phone = null)
    {
        $this->id = $id;
        $this->reservationId = $reservationId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
        $this->phone = $phone;
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
     * Get firstName of the Pilote
     *
     * @return  string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName of the Pilote
     *
     * @param  string  $firstName  firstName of the Pilote
     *
     * @return  self
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get lastName of the Pilote
     *
     * @return  string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set lastName of the Pilote
     *
     * @param  string  $lastName  lastName of the Pilote
     *
     * @return  self
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get age of the Pilote
     *
     * @return  int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set age of the Pilote
     *
     * @param  int  $age  age of the Pilote
     *
     * @return  self
     */
    public function setAge(int $age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get email of the Pilote
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email of the Pilote
     *
     * @param  string  $email  email of the Pilote
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get phone of the Pilote
     *
     * @return  string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone of the Pilote
     *
     * @param  string  $phone  phone of the Pilote
     *
     * @return  self
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

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
