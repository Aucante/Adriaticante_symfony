<?php

namespace App\Tests;

use App\Entity\Coordinates;
use App\Entity\Property;
use PHPUnit\Framework\TestCase;

class CoordinatesUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $coordinates = new Coordinates();
        $property = new Property();

        $coordinates->setLatitude(1);
        $coordinates->setLongitude(1);
        $coordinates->setProperty($property);

        $this->assertTrue($coordinates->getLatitude() === 1);
        $this->assertTrue($coordinates->getLongitude() === 1);
        $this->assertTrue($coordinates->getProperty() === $property);

    }

    public function testIsFalse()
    {
        $coordinates = new Coordinates();
        $property = new Property();

        $coordinates->setLatitude(1);
        $coordinates->setLongitude(1);
        $coordinates->setProperty($property);

        $this->assertFalse($coordinates->getLatitude() === 2);
        $this->assertFalse($coordinates->getLongitude() === 2);
        $this->assertFalse($coordinates->getProperty() === new Property());

    }

    public function testIsEmpty()
    {
        $coordinates = new Coordinates();

        $this->assertEmpty($coordinates->getLatitude());
        $this->assertEmpty($coordinates->getLongitude());
        $this->assertEmpty($coordinates->getProperty());

    }
}
