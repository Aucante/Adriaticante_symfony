<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Please provide the street number")
     * @Assert\Range(min="0", max="99999", notInRangeMessage="This value should be between {{ min }} and {{ max }}.")
     * @ORM\Column(type="integer", nullable=false)
     */
    private $street_number;

    /**
     * @Assert\Length(min=2, max=255)
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $street_address_line_1;

    /**
     * @Assert\Length(min=2, max=255)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street_address_line_2;

    /**
     * @Assert\Length(min=2, max=255)
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @Assert\Length(min=4, max=5)
     * @ORM\Column(type="string", nullable=false)
     */
    private $state_zip_code;

    /**
     * @Assert\Length(min=2, max=50, minMessage="The country must be at least {{ limit }} characters long", maxMessage="The country cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $country;

    /**
     * @Assert\Length(min=2, max=50, minMessage="The county must be at least {{ limit }} characters long", maxMessage="The county cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $county;

    /**
     *  @Assert\Length(min=2, max=20, minMessage="The country code must be at least {{ limit }} characters long", maxMessage="The country code cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", length=255)
     */
    private $dialCode;


    /**
     * @Assert\NotBlank(message="Please provide the phone number")
     * @Assert\Length(min=5, max=13, minMessage="The phone number must be at least {{ limit }} characters long", maxMessage="The phone number cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="integer", nullable=false)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="address")
     */
    private $users;



    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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

    public function getDialCode(): ?string
    {
        return $this->dialCode;
    }

    public function setDialCode(string $dialCode): self
    {
        $this->dialCode = $dialCode;

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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAddress($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAddress() === $this) {
                $user->setAddress(null);
            }
        }

        return $this;
    }



    public function __toString(): string
    {
        if(is_null($this->city)) {
            return 'NULL';
        }
        return $this->city;
    }

}
