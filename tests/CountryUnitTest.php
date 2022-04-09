<?php

namespace App\Tests;

use App\Entity\City;
use App\Entity\Country;
use PHPUnit\Framework\TestCase;

class CountryUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $country = new Country();

        $country->setName('true');

        $this->assertTrue($country->getName() === 'true');
    }

    public function testIsFalse()
    {
        $country = new Country();

        $country->setName('true');

        $this->assertFalse($country->getName() === 'false');
    }

    public function testIsEmpty()
    {
        $country = new Country();

        $this->assertEmpty($country->getName());
    }

    public function testAddGetRemoveCity()
    {
        $country = new Country();
        $city = new City();

        $this->assertEmpty($country->getCity());

        $country->addCity($city);
        $this->assertContains($city, $country->getCity());

        $country->removeCity($city);
        $this->assertEmpty($country->getCity());
    }
}
