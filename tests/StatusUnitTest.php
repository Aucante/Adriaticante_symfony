<?php

namespace App\Tests;

use App\Entity\Status;
use PHPUnit\Framework\TestCase;

class StatusUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $status = new Status();

        $status->setName('true');

        $this->assertTrue($status->getName() === 'true');

    }

    public function testIsFalse()
    {
        $status = new Status();

        $status->setName('true');

        $this->assertFalse($status->getName() === 'false');

    }

    public function testIsEmpty()
    {
        $status = new Status();

        $this->assertEmpty($status->getName());

    }
}
