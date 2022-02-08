<?php

namespace App\Tests;

use App\Entity\Address;
use App\Entity\Coordinates;
use App\Entity\Feature;
use App\Entity\File;
use App\Entity\Property;
use App\Entity\Status;
use App\Entity\Type;
use PHPUnit\Framework\TestCase;

class PropertyUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $property = new Property();
        $type = new Type();
        $address = new Address();


        $property->setPrice(1)
            ->setName('true')
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setType($type)
            ->setAddress($address);

        $this->assertTrue($property->getName() === 'true');
        $this->assertTrue($property->getPrice() === 1);
        $this->assertTrue($property->getDescription() === 'true');
        $this->assertTrue($property->getArea() === 1);
        $this->assertTrue($property->getTotalRooms() === 1);
        $this->assertTrue($property->getTotalBedrooms() === 1);
        $this->assertTrue($property->getTotalBathrooms() === 1);
        $this->assertTrue($property->getType() === $type);
        $this->assertTrue($property->getAddress() === $address);
    }

    public function testIsFalse()
    {
        $property = new Property();
        $type = new Type();
        $address = new Address();


        $property->setPrice(1)
            ->setName('true')
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setType($type)
            ->setAddress($address);

        $this->assertFalse($property->getPrice() === 2);
        $this->assertFalse($property->getName() === 'false');
        $this->assertFalse($property->getDescription() === 'false');
        $this->assertFalse($property->getArea() === 2);
        $this->assertFalse($property->getTotalRooms() === 2);
        $this->assertFalse($property->getTotalBedrooms() === 2);
        $this->assertFalse($property->getTotalBathrooms() === 2);
        $this->assertFalse($property->getType() === new Type());
        $this->assertFalse($property->getAddress() === new Address());

    }

    public function testIsEmpty()
    {
        $property = new Property();



        $this->assertEmpty($property->getName());
        $this->assertEmpty($property->getPrice());
        $this->assertEmpty($property->getDescription());
        $this->assertEmpty($property->getArea());
        $this->assertEmpty($property->getTotalRooms());
        $this->assertEmpty($property->getTotalBedrooms());
        $this->assertEmpty($property->getTotalBathrooms());
        $this->assertEmpty($property->getType());
        $this->assertEmpty($property->getAddress());
    }
}
