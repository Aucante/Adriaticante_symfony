<?php

namespace App\Tests;

use App\Entity\Feature;
use PHPUnit\Framework\TestCase;

class FeatureUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $feature = new Feature();

        $feature->setFeature1('true');
        $feature->setFeature2('true');
        $feature->setFeature3('true');
        $feature->setFeature4('true');
        $feature->setFeature5('true');
        $feature->setFeature6('true');
        $feature->setFeature7('true');
        $feature->setFeature8('true');
        $feature->setFeature9('true');
        $feature->setFeature10('true');

        $this->assertTrue($feature->getFeature1() === 'true');
        $this->assertTrue($feature->getFeature2() === 'true');
        $this->assertTrue($feature->getFeature3() === 'true');
        $this->assertTrue($feature->getFeature4() === 'true');
        $this->assertTrue($feature->getFeature5() === 'true');
        $this->assertTrue($feature->getFeature6() === 'true');
        $this->assertTrue($feature->getFeature7() === 'true');
        $this->assertTrue($feature->getFeature8() === 'true');
        $this->assertTrue($feature->getFeature9() === 'true');
        $this->assertTrue($feature->getFeature10() === 'true');

    }

    public function testIsFalse()
    {
        $feature = new Feature();

        $feature->setFeature1('true');
        $feature->setFeature2('true');
        $feature->setFeature3('true');
        $feature->setFeature4('true');
        $feature->setFeature5('true');
        $feature->setFeature6('true');
        $feature->setFeature7('true');
        $feature->setFeature8('true');
        $feature->setFeature9('true');
        $feature->setFeature10('true');

        $this->assertFalse($feature->getFeature1() === 'false');
        $this->assertFalse($feature->getFeature2() === 'false');
        $this->assertFalse($feature->getFeature3() === 'false');
        $this->assertFalse($feature->getFeature4() === 'false');
        $this->assertFalse($feature->getFeature5() === 'false');
        $this->assertFalse($feature->getFeature6() === 'false');
        $this->assertFalse($feature->getFeature7() === 'false');
        $this->assertFalse($feature->getFeature8() === 'false');
        $this->assertFalse($feature->getFeature9() === 'false');
        $this->assertFalse($feature->getFeature10() === 'false');

    }

    public function testIsEmpty()
    {
        $feature = new Feature();

        $this->assertEmpty($feature->getFeature1());

    }
}
