<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Asin
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $asin;

    /**
     * @var string
     */
    private $title;

    /**
     * @var float
     */
    private $map;

    /**
     * @var User
     */
    private $user;

    /**
     * @var AsinChild[]
     */
    private $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title ? $this->title : 'New Asin';
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set asin
     *
     * @param string $asin
     *
     * @return Asin
     */
    public function setAsin($asin)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get asin
     *
     * @return string
     */
    public function getAsin()
    {
        return $this->asin;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Asin
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set map
     *
     * @param float $map
     *
     * @return Asin
     */
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get map
     *
     * @return float
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}

