<?php


namespace App\Data;


use App\Entity\City;
use App\Entity\Feature;

class SearchData
{
    /**
     * @var null|string
     */
    public string $q;

    /**
     * @var null|integer
     */
    public ?int $priceMin;

    /**
     * @var null|integer
     */
    public ?int $priceMax;

    /**
     * @var null|integer
     */
    public ?int $areaMin;

    /**
     * @var null|integer
     */
    public ?int $areaMax;

    /**
     * @var null|integer
     */
    public ?int $roomsMin;

    /**
     * @var null|integer
     */
    public ?int $roomsMax;

    /**
     * @var null|integer
     */
    public ?int $bedroomsMin;

    /**
     * @var null|integer
     */
    public ?int $bedroomsMax;

    /**
     * @var null|integer
     */
    public ?int $bathroomsMin;

    /**
     * @var null|integer
     */
    public ?int $bathroomsMax;

    /**
     * @var null|string
     */
    public ?string $type;

    /**
     * @var null|string
     */
    public ?string $advertType;

    /**
     * @var City
     */
    public City $city;

    /**
     * @var Feature[]
     */
    public array $features = [];

}