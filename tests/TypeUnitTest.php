<?php

namespace App\Tests;

use App\Entity\Type;
use PHPUnit\Framework\TestCase;

class TypeUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $type = new Type();

        $type->setName('true');

        $this->assertTrue($type->getName() === 'true');

    }

    public function testIsFalse()
    {
        $type = new type();

        $type->setName('true');

        $this->assertFalse($type->getName() === 'false');

    }

    public function testIsEmpty()
    {
        $type = new Type();

        $this->assertEmpty($type->getName());

    }
}
