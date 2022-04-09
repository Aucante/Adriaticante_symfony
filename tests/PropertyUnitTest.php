<?php

namespace App\Tests;

use App\Entity\Address;
use App\Entity\City;
use App\Entity\Feature;
use App\Entity\Image;
use App\Entity\Property;
use App\Entity\Thread;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class PropertyUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $property = new Property();
        $user = new User();
        $city = new City();
        $dateTime = new \DateTimeImmutable();

        $property->setPrice(1)
            ->setName('true')
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setUser($user)
            ->setStatus('true')
            ->setType('true')
            ->setAdvertType('true')
            ->setLinkWebsite('true')
            ->setPhoneContact(1)
            ->setNameContact('true')
            ->setCreatedAt($dateTime)
            ->setSlug('true')
            ->setCity($city);

        $this->assertTrue($property->getName() === 'true');
        $this->assertTrue($property->getPrice() === 1);
        $this->assertTrue($property->getDescription() === 'true');
        $this->assertTrue($property->getArea() === 1);
        $this->assertTrue($property->getTotalRooms() === 1);
        $this->assertTrue($property->getTotalBedrooms() === 1);
        $this->assertTrue($property->getTotalBathrooms() === 1);
        $this->assertTrue($property->getUser() === $user);
        $this->assertTrue($property->getStatus() === 'true');
        $this->assertTrue($property->getType() === 'true');
        $this->assertTrue($property->getAdvertType() === 'true');
        $this->assertTrue($property->getLinkWebsite() === 'true');
        $this->assertTrue($property->getPhoneContact() === 1);
        $this->assertTrue($property->getNameContact() === 'true');
        $this->assertTrue($property->getCreatedAt() === $dateTime);
        $this->assertTrue($property->getSlug() === 'true');
        $this->assertTrue($property->getCity() === $city);
    }

    public function testIsFalse()
    {
        $property = new Property();
        $user = new User();
        $city = new City();
        $dateTime = new \DateTimeImmutable();

        $property->setPrice(1)
            ->setName('true')
            ->setDescription('true')
            ->setArea(1)
            ->setTotalRooms(1)
            ->setTotalBedrooms(1)
            ->setTotalBathrooms(1)
            ->setUser($user)
            ->setStatus('true')
            ->setType('true')
            ->setAdvertType('true')
            ->setLinkWebsite('true')
            ->setPhoneContact(1)
            ->setNameContact('true')
            ->setCreatedAt($dateTime)
            ->setSlug('true')
            ->setCity($city);

        $this->assertFalse($property->getPrice() === 2);
        $this->assertFalse($property->getName() === 'false');
        $this->assertFalse($property->getDescription() === 'false');
        $this->assertFalse($property->getArea() === 2);
        $this->assertFalse($property->getTotalRooms() === 2);
        $this->assertFalse($property->getTotalBedrooms() === 2);
        $this->assertFalse($property->getTotalBathrooms() === 2);
        $this->assertFalse($property->getUser() === new User());
        $this->assertFalse($property->getStatus() === 'false');
        $this->assertFalse($property->getType() === 'false');
        $this->assertFalse($property->getAdvertType() === 'false');
        $this->assertFalse($property->getLinkWebsite() === 'false');
        $this->assertFalse($property->getPhoneContact() === 2);
        $this->assertFalse($property->getNameContact() === 'false');
        $this->assertFalse($property->getCreatedAt() === new \DateTimeImmutable());
        $this->assertFalse($property->getSlug() === 'false');
        $this->assertFalse($property->getCity() === new City());

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
        $this->assertEmpty($property->getId());
        $this->assertEmpty($property->getUser());
        $this->assertEmpty($property->getStatus());
        $this->assertEmpty($property->getType());
        $this->assertEmpty($property->getAdvertType());
        $this->assertEmpty($property->getLinkWebsite());
        $this->assertEmpty($property->getPhoneContact());
        $this->assertEmpty($property->getNameContact());
        $this->assertEmpty($property->getCreatedAt());
        $this->assertEmpty($property->getSlug());
        $this->assertEmpty($property->getCity());
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

    public function testAddGetRemoveImage()
    {
        $property = new Property();
        $image = new Image();

        $this->assertEmpty($property->getImages());

        $property->addImage($image);
        $this->assertContains($image, $property->getImages());

        $property->removeImage($image);
        $this->assertEmpty($property->getImages());
    }

    public function testAddGetRemoveThread()
    {
        $property = new Property();
        $thread = new Thread();

        $this->assertEmpty($property->getThreads());

        $property->addThread($thread);
        $this->assertContains($thread, $property->getThreads());

        $property->removeThread($thread);
        $this->assertEmpty($property->getThreads());
    }

}
