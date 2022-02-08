<?php

namespace App\Tests;

use App\Entity\File;
use App\Entity\Property;
use PHPUnit\Framework\TestCase;

class FileUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $file = new File();

        $file->setName('true');

        $this->assertTrue($file->getName() === 'true');

    }

    public function testIsFalse()
    {
        $file = new File();

        $file->setName('true');

        $this->assertFalse($file->getName() === 'false');

    }

    public function testIsEmpty()
    {
        $file = new File();

        $this->assertEmpty($file->getName());

    }
}
