<?php

namespace App\Data;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Feature;

class SearchData
{
    /**
     * @var string|null
     */
    public string $q;

    public ?int $priceMin;

    public ?int $priceMax;

    public ?int $areaMin;

    public ?int $areaMax;

    public ?int $roomsMin;

    public ?int $roomsMax;

    public ?int $bedroomsMin;

    public ?int $bedroomsMax;

    public ?int $bathroomsMin;

    public ?int $bathroomsMax;

    public ?string $type;

    public ?string $advertType;

    public Country $country;

    public City $city;

    /**
     * @var Feature[]
     */
    public array $features = [];
}
