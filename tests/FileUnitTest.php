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
        $property = new Property();

        $file->setFile1('true');
        $file->setFile2('true');
        $file->setFile3('true');
        $file->setFile4('true');
        $file->setFile5('true');
        $file->setFile6('true');
        $file->setFile7('true');
        $file->setFile8('true');
        $file->setFile9('true');
        $file->setFile10('true');
        $file->setProperty($property);

        $this->assertTrue($file->getFile1() === 'true');
        $this->assertTrue($file->getFile2() === 'true');
        $this->assertTrue($file->getFile3() === 'true');
        $this->assertTrue($file->getFile4() === 'true');
        $this->assertTrue($file->getFile5() === 'true');
        $this->assertTrue($file->getFile6() === 'true');
        $this->assertTrue($file->getFile7() === 'true');
        $this->assertTrue($file->getFile8() === 'true');
        $this->assertTrue($file->getFile9() === 'true');
        $this->assertTrue($file->getFile10() === 'true');
        $this->assertTrue($file->getProperty() === $property);

    }

    public function testIsFalse()
    {
        $file = new File();
        $property = new Property();

        $file->setFile1('true');
        $file->setFile2('true');
        $file->setFile3('true');
        $file->setFile4('true');
        $file->setFile5('true');
        $file->setFile6('true');
        $file->setFile7('true');
        $file->setFile8('true');
        $file->setFile9('true');
        $file->setFile10('true');
        $file->setProperty($property);

        $this->assertFalse($file->getFile1() === 'false');
        $this->assertFalse($file->getFile2() === 'false');
        $this->assertFalse($file->getFile3() === 'false');
        $this->assertFalse($file->getFile4() === 'false');
        $this->assertFalse($file->getFile5() === 'false');
        $this->assertFalse($file->getFile6() === 'false');
        $this->assertFalse($file->getFile7() === 'false');
        $this->assertFalse($file->getFile8() === 'false');
        $this->assertFalse($file->getFile9() === 'false');
        $this->assertFalse($file->getFile10() === 'false');
        $this->assertFalse($file->getProperty() === new Property());

    }

    public function testIsEmpty()
    {
        $file = new File();

        $this->assertEmpty($file->getFile1());
        $this->assertEmpty($file->getFile2());
        $this->assertEmpty($file->getFile3());
        $this->assertEmpty($file->getFile4());
        $this->assertEmpty($file->getFile5());
        $this->assertEmpty($file->getFile6());
        $this->assertEmpty($file->getFile7());
        $this->assertEmpty($file->getFile8());
        $this->assertEmpty($file->getFile9());
        $this->assertEmpty($file->getFile10());
        $this->assertEmpty($file->getProperty());

    }
}
