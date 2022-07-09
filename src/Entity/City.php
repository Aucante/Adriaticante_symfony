<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Please provide the city's name.")
     * @Assert\Length(min=2, max=50)
     * @ORM\Column(type="string", length=255)
     * @Groups("property:read")
     */
    private $name;

    /**
     * @Assert\Range(min=2, max=9999999999)
     * @ORM\Column(type="decimal", precision=10, scale=7)
     */
    private $latitude;

    /**
     * @Assert\Range(min=2, max=9999999999)
     * @ORM\Column(type="decimal", precision=10, scale=7)
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="city", cascade={"persist"})
     */
    private $property;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="city")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("property:read")
     */
    private $country;

    public function __construct()
    {
        $this->property = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Property[]
     */
    public function getProperty(): Collection
    {
        return $this->property;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->property->contains($property)) {
            $this->property[] = $property;
            $property->setCity($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->property->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getCity() === $this) {
                $property->setCity(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
