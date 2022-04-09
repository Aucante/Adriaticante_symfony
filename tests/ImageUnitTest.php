<?php

namespace App\Tests;

use App\Entity\Image;
use App\Entity\Property;
use PHPUnit\Framework\TestCase;

class ImageUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $file = new Image();
        $property = new Property();

        $file->setName('true')
            ->setProperty($property);

        $this->assertTrue($file->getName() === 'true');
        $this->assertTrue($file->getProperty() === $property);

    }

    public function testIsFalse()
    {
        $file = new Image();
        $property = new Property();

        $file->setName('true')
            ->setProperty($property);

        $this->assertFalse($file->getName() === 'false');
        $this->assertFalse($file->getProperty() === new Property());

    }

    public function testIsEmpty()
    {
        $file = new Image();

        $this->assertEmpty($file->getName());
        $this->assertEmpty($file->getId());
        $this->assertEmpty($file->getProperty());

    }
}
