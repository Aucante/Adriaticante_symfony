<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $street_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street_address_line_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street_address_line_2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $state_zip_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $county;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreetNumber(): ?int
    {
        return $this->street_number;
    }

    public function setStreetNumber(int $street_number): self
    {
        $this->street_number = $street_number;

        return $this;
    }

    public function getStreetAddressLine1(): ?string
    {
        return $this->street_address_line_1;
    }

    public function setStreetAddressLine1(string $street_address_line_1): self
    {
        $this->street_address_line_1 = $street_address_line_1;

        return $this;
    }

    public function getStreetAddressLine2(): ?string
    {
        return $this->street_address_line_2;
    }

    public function setStreetAddressLine2(?string $street_address_line_2): self
    {
        $this->street_address_line_2 = $street_address_line_2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStateZipCode(): ?int
    {
        return $this->state_zip_code;
    }

    public function setStateZipCode(int $state_zip_code): self
    {
        $this->state_zip_code = $state_zip_code;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCounty(): ?string
    {
        return $this->county;
    }

    public function setCounty(?string $county): self
    {
        $this->county = $county;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
