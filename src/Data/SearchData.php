<?php


namespace App\Data;


class SearchData
{
    /**
     * @var null|string
     */
    public string $q;

    /**
     * @var null|integer
     */
    public ?int $minPrice;

    /**
     * @var null|integer
     */
    public ?int $maxPrice;

}