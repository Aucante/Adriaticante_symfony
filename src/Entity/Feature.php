<?php

namespace App\Entity;

use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FeatureRepository::class)
 */
class Feature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feature1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature7;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature8;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature9;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feature10;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeature1(): ?string
    {
        return $this->feature1;
    }

    public function setFeature1(string $feature1): self
    {
        $this->feature1 = $feature1;

        return $this;
    }

    public function getFeature2(): ?string
    {
        return $this->feature2;
    }

    public function setFeature2(?string $feature2): self
    {
        $this->feature2 = $feature2;

        return $this;
    }

    public function getFeature3(): ?string
    {
        return $this->feature3;
    }

    public function setFeature3(?string $feature3): self
    {
        $this->feature3 = $feature3;

        return $this;
    }

    public function getFeature4(): ?string
    {
        return $this->feature4;
    }

    public function setFeature4(?string $feature4): self
    {
        $this->feature4 = $feature4;

        return $this;
    }

    public function getFeature5(): ?string
    {
        return $this->feature5;
    }

    public function setFeature5(?string $feature5): self
    {
        $this->feature5 = $feature5;

        return $this;
    }

    public function getFeature6(): ?string
    {
        return $this->feature6;
    }

    public function setFeature6(?string $feature6): self
    {
        $this->feature6 = $feature6;

        return $this;
    }

    public function getFeature7(): ?string
    {
        return $this->feature7;
    }

    public function setFeature7(?string $feature7): self
    {
        $this->feature7 = $feature7;

        return $this;
    }

    public function getFeature8(): ?string
    {
        return $this->feature8;
    }

    public function setFeature8(?string $feature8): self
    {
        $this->feature8 = $feature8;

        return $this;
    }

    public function getFeature9(): ?string
    {
        return $this->feature9;
    }

    public function setFeature9(?string $feature9): self
    {
        $this->feature9 = $feature9;

        return $this;
    }

    public function getFeature10(): ?string
    {
        return $this->feature10;
    }

    public function setFeature10(?string $feature10): self
    {
        $this->feature10 = $feature10;

        return $this;
    }
}
