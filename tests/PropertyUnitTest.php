<?php

namespace App\Tests;

use App\Entity\Address;
use App\Entity\Feature;
use App\Entity\Property;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class PropertyUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $property = new Property();
        $address = new Address();
        $user = new User();



        $property->setPrice(1)
            ->setName('true')
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setAddress($address)
            ->setUser($user)
            ->setAdvertType('true');

        $this->assertTrue($property->getName() === 'true');
        $this->assertTrue($property->getPrice() === 1);
        $this->assertTrue($property->getDescription() === 'true');
        $this->assertTrue($property->getArea() === 1);
        $this->assertTrue($property->getTotalRooms() === 1);
        $this->assertTrue($property->getTotalBedrooms() === 1);
        $this->assertTrue($property->getTotalBathrooms() === 1);
        $this->assertTrue($property->getAddress() === $address);
        $this->assertTrue($property->getUser() === $user);
        $this->assertTrue($property->getAdvertType() === 'true');
    }

    public function testIsFalse()
    {
        $property = new Property();
        $address = new Address();
        $user = new User();


        $property->setPrice(1)
            ->setName('true')
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setAddress($address)
            ->setUser($user)
            ->setAdvertType('true');

        $this->assertFalse($property->getPrice() === 2);
        $this->assertFalse($property->getName() === 'false');
        $this->assertFalse($property->getDescription() === 'false');
        $this->assertFalse($property->getArea() === 2);
        $this->assertFalse($property->getTotalRooms() === 2);
        $this->assertFalse($property->getTotalBedrooms() === 2);
        $this->assertFalse($property->getTotalBathrooms() === 2);
        $this->assertFalse($property->getAddress() === new Address());
        $this->assertFalse($property->getUser() === new User());
        $this->assertFalse($property->getAdvertType() === 'false');

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
        $this->assertEmpty($property->getAddress());
        $this->assertEmpty($property->getId());
        $this->assertEmpty($property->getUser());
        $this->assertEmpty($property->getAdvertType());
    }

    public function testAddGetRemoveFeature()
    {

        $property = new Property();
        $feature = new Feature();

        $this->assertEmpty($property->getFeatures());

        $property->addFeature($feature);
        $this->assertContains($feature, $property->getFeatures());

        $property->removeFeature($feature);
        $this->assertEmpty($property->getFeatures());


    }

}
