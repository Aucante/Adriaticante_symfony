<?php

namespace App\Tests;

use App\Entity\Contact;
use App\Entity\Property;
use PHPUnit\Framework\TestCase;

class ContactUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $contact = new Contact();
        $property = new Property();

        $contact->setFirstname('true')
            ->setLastname('true')
            ->setEmail('true')
            ->setPhone('0600000000')
            ->setMessage('true')
            ->setProperty($property);


        $this->assertTrue($contact->getFirstname() === 'true');
        $this->assertTrue($contact->getLastname() === 'true');
        $this->assertTrue($contact->getEmail() === 'true');
        $this->assertTrue($contact->getPhone() === '0600000000');
        $this->assertTrue($contact->getMessage() === 'true');
        $this->assertTrue($contact->getProperty() === $property);
    }

    public function testIsFalse()
    {
        $contact = new Contact();
        $property = new Property();

        $contact->setFirstname('true')
            ->setLastname('true')
            ->setEmail('true')
            ->setPhone('0600000000')
            ->setMessage('true')
            ->setProperty($property);


        $this->assertFalse($contact->getFirstname() === 'false');
        $this->assertFalse($contact->getLastname() === 'false');
        $this->assertFalse($contact->getEmail() === 'false');
        $this->assertFalse($contact->getPhone() === '0700000000');
        $this->assertFalse($contact->getMessage() === 'false');
        $this->assertFalse($contact->getProperty() === new Property());
    }

    public function testIsEmpty()
    {
        $contact = new Contact();

        $this->assertEmpty($contact->getFirstname());
        $this->assertEmpty($contact->getLastname());
        $this->assertEmpty($contact->getEmail());
        $this->assertEmpty($contact->getPhone());
        $this->assertEmpty($contact->getMessage());
    }
}
