<?php

namespace AppBundle\Entity;

/**
 * AsinChild
 */
class AsinChild
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $sellerName;

    /**
     * @var float
     */
    private $livePrice;

    /**
     * @var Asin
     */
    private $asin;

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
     * Set sellerName
     *
     * @param string $sellerName
     *
     * @return AsinChild
     */
    public function setSellerName($sellerName)
    {
        $this->sellerName = $sellerName;

        return $this;
    }

    /**
     * Get sellerName
     *
     * @return string
     */
    public function getSellerName()
    {
        return $this->sellerName;
    }

    /**
     * Set livePrice
     *
     * @param float $livePrice
     *
     * @return AsinChild
     */
    public function setLivePrice($livePrice)
    {
        $this->livePrice = $livePrice;

        return $this;
    }

    /**
     * Get livePrice
     *
     * @return float
     */
    public function getLivePrice()
    {
        return $this->livePrice;
    }

    /**
     * @return Asin
     */
    public function getAsin()
    {
        return $this->asin;
    }

    /**
     * @param Asin $asin
     */
    public function setAsin($asin)
    {
        $this->asin = $asin;
    }
}

