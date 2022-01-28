<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
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
    private $file1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file7;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file8;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file9;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file10;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile1(): ?string
    {
        return $this->file1;
    }

    public function setFile1(string $file1): self
    {
        $this->file1 = $file1;

        return $this;
    }

    public function getFile2(): ?string
    {
        return $this->file2;
    }

    public function setFile2(string $file2): self
    {
        $this->file2 = $file2;

        return $this;
    }

    public function getFile3(): ?string
    {
        return $this->file3;
    }

    public function setFile3(string $file3): self
    {
        $this->file3 = $file3;

        return $this;
    }

    public function getFile4(): ?string
    {
        return $this->file4;
    }

    public function setFile4(?string $file4): self
    {
        $this->file4 = $file4;

        return $this;
    }

    public function getFile5(): ?string
    {
        return $this->file5;
    }

    public function setFile5(?string $file5): self
    {
        $this->file5 = $file5;

        return $this;
    }

    public function getFile6(): ?string
    {
        return $this->file6;
    }

    public function setFile6(?string $file6): self
    {
        $this->file6 = $file6;

        return $this;
    }

    public function getFile7(): ?string
    {
        return $this->file7;
    }

    public function setFile7(?string $file7): self
    {
        $this->file7 = $file7;

        return $this;
    }

    public function getFile8(): ?string
    {
        return $this->file8;
    }

    public function setFile8(?string $file8): self
    {
        $this->file8 = $file8;

        return $this;
    }

    public function getFile9(): ?string
    {
        return $this->file9;
    }

    public function setFile9(?string $file9): self
    {
        $this->file9 = $file9;

        return $this;
    }

    public function getFile10(): ?string
    {
        return $this->file10;
    }

    public function setFile10(?string $file10): self
    {
        $this->file10 = $file10;

        return $this;
    }
}
