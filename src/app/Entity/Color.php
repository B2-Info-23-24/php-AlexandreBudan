<?php

namespace Entity;

class Color
{
    // Properties

    /**
     * @var int id Primary Key
     */
    private $id;

    /**
     * @var string name of the Color
     */
    private $colorName;

    // Constructor

    /**
     * Color constructor
     *
     * @param  int  $id  id Primary Key
     * @param  string  $colorName  name of the Color
     *
     * @return  void
     */
    public function __construct(int $id, string $colorName = null)
    {
        $this->id = $id;
        $this->colorName = $colorName;
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
    public function getColorName()
    {
        return $this->colorName;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setColorName($colorName)
    {
        $this->colorName = $colorName;

        return $this;
    }
}
