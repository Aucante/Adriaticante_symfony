<?php
namespace App\Entity;

class PropertySearch {

    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minArea;

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(?int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinArea(): ?int
    {
        return $this->minArea;
    }

    /**
     * @param int|null $minArea
     * @return PropertySearch
     */
    public function setMinArea(?int $minArea): PropertySearch
    {
        $this->minArea = $minArea;
        return $this;
    }



}