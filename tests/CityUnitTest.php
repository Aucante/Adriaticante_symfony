<?php

namespace App\Tests;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Property;
use PHPUnit\Framework\TestCase;

class CityUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $city = new City();
        $country = new Country();

        $city->setName('true')
            ->setLatitude('42.430000')
            ->setLongitude('18.700000')
            ->setCountry($country);

        $this->assertTrue($city->getName() === 'true');
        $this->assertTrue($city->getLatitude() === '42.430000');
        $this->assertTrue($city->getLongitude() === '18.700000');
        $this->assertTrue($city->getCountry() === $country);
    }

    public function testIsFalse()
    {
        $city = new City();
        $country = new Country();

        $city->setName('true')
            ->setLatitude('42.430000')
            ->setLongitude('18.700000')
            ->setCountry($country);

        $this->assertFalse($city->getName() === 'false');
        $this->assertFalse($city->getLatitude() === '42.430001');
        $this->assertFalse($city->getLongitude() === '18.700001');
        $this->assertFalse($city->getCountry() === new Country());
    }

    public function testIsEmpty()
    {
        $city = new City();

        $this->assertEmpty($city->getName());
        $this->assertEmpty($city->getLatitude());
        $this->assertEmpty($city->getLongitude());
        $this->assertEmpty($city->getCountry());
    }

    public function testAddGetRemoveProperty()
    {
        $city = new City();
        $property = new Property();

        $this->assertEmpty($city->getProperty());

        $city->addProperty($property);
        $this->assertContains($property, $city->getProperty());

        $city->removeProperty($property);
        $this->assertEmpty($city->getProperty());
    }
}
