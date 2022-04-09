<?php

namespace App\Tests;

use App\Entity\Address;
use App\Entity\Property;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class AddressUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $address = new Address();

        $address->setStreetNumber(1)
            ->setStreetAddressLine1('true')
            ->setStreetAddressLine2('true')
            ->setCity('true')
            ->setStateZipCode(10000)
            ->setCountry('true')
            ->setCounty('true')
            ->setPhone(0100000000);

        $this->assertTrue($address->getStreetNumber() === 1);
        $this->assertTrue($address->getStreetAddressLine1() === 'true');
        $this->assertTrue($address->getStreetAddressLine2() === 'true');
        $this->assertTrue($address->getCity() === 'true');
        $this->assertTrue($address->getStateZipCode() === 10000);
        $this->assertTrue($address->getCountry() === 'true');
        $this->assertTrue($address->getCounty() === 'true');
        $this->assertTrue($address->getPhone() === 0100000000);

    }

    public function testIsFalse()
    {
        $address = new Address();

        $address->setStreetNumber(1)
            ->setStreetAddressLine1('true')
            ->setStreetAddressLine2('true')
            ->setCity('true')
            ->setStateZipCode(10000)
            ->setCountry('true')
            ->setCounty('true')
            ->setPhone(0100000000);

        $this->assertFalse($address->getStreetNumber() === 2);
        $this->assertFalse($address->getStreetAddressLine1() === 'false');
        $this->assertFalse($address->getStreetAddressLine2() === 'false');
        $this->assertFalse($address->getCity() === 'false');
        $this->assertFalse($address->getStateZipCode() === 99999);
        $this->assertFalse($address->getCountry() === 'false');
        $this->assertFalse($address->getCounty() === 'false');
        $this->assertFalse($address->getPhone() === 9900000000);
    }

    public function testIsEmpty()
    {
        $address = new Address();

        $this->assertEmpty($address->getStreetNumber());
        $this->assertEmpty($address->getStreetAddressLine1());
        $this->assertEmpty($address->getStreetAddressLine2());
        $this->assertEmpty($address->getCity());
        $this->assertEmpty($address->getStateZipCode());
        $this->assertEmpty($address->getCountry());
        $this->assertEmpty($address->getCounty());
        $this->assertEmpty($address->getPhone());
        $this->assertEmpty($address->getId());

    }

    public function testAddGetRemoveUsers()
    {
        $address = new Address();
        $user = new User();

        $this->assertEmpty($address->getUsers());

        $address->addUser($user);
        $this->assertContains($user, $address->getUsers());

        $address->removeUser($user);
        $this->assertEmpty($address->getUsers());

    }

}
