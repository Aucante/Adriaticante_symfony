<?php

namespace App\Entity;

use App\Repository\CoordinatesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoordinatesRepository::class)
 */
class Coordinates
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
    private $latitude;

    /**
     * @ORM\Column(type="integer")
     */
    private $longitude;

    /**
     * @ORM\OneToOne(targetEntity=Property::class, mappedBy="coordinates", cascade={"persist", "remove"})
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?int
    {
        return $this->latitude;
    }

    public function setLatitude(int $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->longitude;
    }

    public function setLongitude(int $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        // unset the owning side of the relation if necessary
        if ($property === null && $this->property !== null) {
            $this->property->setCoordinates(null);
        }

        // set the owning side of the relation if necessary
        if ($property !== null && $property->getCoordinates() !== $this) {
            $property->setCoordinates($this);
        }

        $this->property = $property;

        return $this;
    }
}
