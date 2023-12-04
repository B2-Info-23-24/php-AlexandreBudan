<?php

namespace Entity;

use DateTime;

class User
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var string email of the User
     */
    private $email;

    /**
     * @var string password of the User
     */
    private $password;

    /**
     * @var string firstName of the User
     */
    private $firstName;

    /**
     * @var string lastName of the User
     */
    private $lastName;

    /**
     * @var string phone of the User
     */
    private $phone;

    /**
     * @var string age of the User
     */
    private $age;

    /**
     * @var string gender of the User
     */
    private $gender;

    /**
     * @var Address address of the User
     */
    private $address;

    /**
     * @var array reservations of the User
     */
    private $reservations;

    /**
     * @var array favoris of the User
     */
    private $favoris;

    /**
     * @var array opinions of the User
     */
    private $opinions;

    /**
     * @var string creation date of the User
     */
    private $creationDate;

    /**
     * @var bool if User wants to received newsLetter
     */
    private $newsLetter;

    /**
     * @var bool if User verified his account
     */
    private $verified;

    /**
     * @var bool if User is Admin or Not
     */
    private $isAdmin;

    /**
     * @var bool status for Data Management
     */
    private $status;

    // Constructor

    /**
     * User constructor
     *
     * @param int $id User ID
     * @param string $email User email
     * @param string $password User password
     * @param string $firstName User first name
     * @param string $lastName User last name
     * @param string $phone User phone number
     * @param int $age User age
     * @param string $gender User gender
     * @param Address $address User address
     * @param array $reservations User reservations
     * @param array $favoris User favoris
     * @param array $opinions User opinions
     * @param bool $newsLetter If User wants to receive newsletter
     * @param bool $verified If User has verified his account
     * @param bool $isAdmin If User is an admin or not
     * @return void
     */
    public function __construct(int $id, string $email = null, string $password = null, string $firstName = null, string $lastName = null, string $phone = null, int $age = null, string $gender = null, Address $address = null, array $reservations = [], array $favoris = [], array $opinions = [], string $creationDate = null, bool $newsLetter = null, bool $verified = null, bool $isAdmin = null, bool $status = true)
    {
        if ($creationDate == null) {
            $date = new DateTime();
            $dateString = $date->format('Y-m-d H:i:s');
        } else {
            $dateString = $creationDate;
        }

        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->age = $age;
        $this->gender = $gender;
        $this->address = $address;
        $this->reservations = $reservations;
        $this->favoris = $favoris;
        $this->opinions = $opinions;
        $this->creationDate = $dateString;
        $this->newsLetter = $newsLetter;
        $this->verified = $verified;
        $this->isAdmin = $isAdmin;
        $this->status = $status;
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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

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
     * Get the value of reservations
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Set the value to reservations
     *
     * @return  self
     */
    public function setReservation($reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }

    /**
     * Add the value to reservations
     *
     * @return  self
     */
    public function addReservation($reservation)
    {
        array_push($this->reservations, $reservation);

        return $this;
    }

    /**
     * Get the value of favoris
     */
    public function getFavoris()
    {
        return $this->favoris;
    }

    /**
     * Add the value to favoris
     *
     * @return  self
     */
    public function addFavori($favori)
    {
        array_push($this->favoris, $favori);

        return $this;
    }

    /**
     * Get the value of creationDate
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of newsLetter
     */
    public function getNewsLetter()
    {
        return $this->newsLetter;
    }

    /**
     * Set the value of newsLetter
     *
     * @return  self
     */
    public function setNewsLetter($newsLetter)
    {
        $this->newsLetter = $newsLetter;

        return $this;
    }

    /**
     * Get the value of verified
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set the value of verified
     *
     * @return  self
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

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

    /**
     * Get the value of opinions
     */
    public function getOpinions()
    {
        return $this->opinions;
    }

    /**
     * Set the value of opinions
     *
     * @return  self
     */
    public function setOpinions($opinions)
    {
        $this->opinions = $opinions;

        return $this;
    }
}
