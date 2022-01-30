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
        $feature = new Feature();
        $type = new Type();
        $status = new Status();
        $address = new Address();
        $coordinates = new Coordinates();
        $file = new File();


        $property->setPrice(1)
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setFeatures($feature)
            ->setType($type)
            ->setStatus($status)
            ->setAddress($address)
            ->setCoordinates($coordinates)
            ->setFiles($file);

        $this->assertTrue($property->getPrice() === 1);
        $this->assertTrue($property->getDescription() === 'true');
        $this->assertTrue($property->getArea() === 1);
        $this->assertTrue($property->getTotalRooms() === 1);
        $this->assertTrue($property->getTotalBedrooms() === 1);
        $this->assertTrue($property->getTotalBathrooms() === 1);
        $this->assertTrue($property->getFeatures() === $feature);
        $this->assertTrue($property->getType() === $type);
        $this->assertTrue($property->getStatus() === $status);
        $this->assertTrue($property->getAddress() === $address);
        $this->assertTrue($property->getCoordinates() === $coordinates);
        $this->assertTrue($property->getFiles() === $file);
    }

    public function testIsFalse()
    {
        $property = new Property();
        $feature = new Feature();
        $type = new Type();
        $status = new Status();
        $address = new Address();
        $coordinates = new Coordinates();
        $file = new File();


        $property->setPrice(1)
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setFeatures($feature)
            ->setType($type)
            ->setStatus($status)
            ->setAddress($address)
            ->setCoordinates($coordinates)
            ->setFiles($file);

        $this->assertFalse($property->getPrice() === 2);
        $this->assertFalse($property->getDescription() === 'false');
        $this->assertFalse($property->getArea() === 2);
        $this->assertFalse($property->getTotalRooms() === 2);
        $this->assertFalse($property->getTotalBedrooms() === 2);
        $this->assertFalse($property->getTotalBathrooms() === 2);
        $this->assertFalse($property->getFeatures() === new Feature());
        $this->assertFalse($property->getType() === new Type());
        $this->assertFalse($property->getStatus() === new Status());
        $this->assertFalse($property->getAddress() === new Address());
        $this->assertFalse($property->getCoordinates() === new Coordinates());
        $this->assertFalse($property->getFiles() === new File());
    }

    public function testIsEmpty()
    {
        $property = new Property();
        $feature = new Feature();
        $type = new Type();
        $status = new Status();
        $address = new Address();
        $coordinates = new Coordinates();
        $file = new File();



        $this->assertEmpty($property->getPrice());
        $this->assertEmpty($property->getDescription());
        $this->assertEmpty($property->getArea());
        $this->assertEmpty($property->getTotalRooms());
        $this->assertEmpty($property->getTotalBedrooms());
        $this->assertEmpty($property->getTotalBathrooms());
        $this->assertEmpty($property->getFeatures());
        $this->assertEmpty($property->getType());
        $this->assertEmpty($property->getStatus());
        $this->assertEmpty($property->getAddress());
        $this->assertEmpty($property->getCoordinates());
        $this->assertEmpty($property->getFiles());
    }
}
