<?php

namespace Entity;

class Brand
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var string name of the Brand
     */
    private $brandName;

    // Constructor

    /**
     * Brand constructor
     *
     * @param  int  $id  id Primary Key
     * @param  string  $brandName  name of the Brand
     *
     * @return  void
     */
    public function __construct(int $id, string $brandName = null)
    {
        $this->id = $id;
        $this->brandName = $brandName;
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
     * Get the value of name
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;

        return $this;
    }
}
