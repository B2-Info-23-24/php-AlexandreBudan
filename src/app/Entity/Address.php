<?php

namespace Entity;

class Address
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var string name of the Address
     */
    private $address;

    /**
     * @var string city of the Address
     */
    private $city;

    /**
     * @var string postal code of the Address
     */
    private $code;

    /**
     * @var string country of the Address
     */
    private $country;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor

    /**
     * Address constructor
     *
     * @param  int  $id  id Primary Key
     * @param  string  $address  name of the Address
     * @param  string  $city  city of the Address
     * @param  string  $code  postal code of the Address
     * @param  string  $country  country of the Address
     *
     * @return  void
     */
    public function __construct(int $id, string $address = null, string $city = null, string $code = null, string $country = null)
    {
        $this->id = $id;
        $this->address = $address;
        $this->city = $city;
        $this->code = $code;
        $this->country = $country;
        $this->status = true;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
