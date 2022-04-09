<?php

namespace App\Tests;

use App\Entity\Address;
use App\Entity\Message;
use App\Entity\Property;
use App\Entity\Thread;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();
        $address = new Address();
        $updatedAt = new \DateTimeImmutable();

        $user->setEmail('mail@test.com')
             ->setPassword('password')
             ->setUsername('username')
             ->setLastname('lastname')
             ->setFirstname('firstname')
             ->setCompany('company')
             ->setAddress($address)
            ->setFile('true')
            ->setUpdatedAt($updatedAt)
            ->setProfessional(true);

        $this->assertTrue($user->getEmail() === 'mail@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getUsername() === 'username');
        $this->assertTrue($user->getLastname() === 'lastname');
        $this->assertTrue($user->getFirstname() === 'firstname');
        $this->assertTrue($user->getCompany() === 'company');
        $this->assertTrue($user->getAddress() === $address);
        $this->assertTrue($user->getFile() === 'true');
        $this->assertTrue($user->getUpdatedAt() === $updatedAt);
        $this->assertTrue($user->getProfessional() === true);

    }

    public function testIsFalse()
    {
        $user = new User();
        $address = new Address();
        $updatedAt = new \DateTimeImmutable();

        $user->setEmail('true@test.com')
             ->setPassword('true')
             ->setUsername('true')
             ->setLastname('true')
             ->setFirstname('true')
             ->setCompany('true')
            ->setAddress($address)
            ->setFile('true')
            ->setUpdatedAt($updatedAt)
            ->setProfessional(true);

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getUsername() === 'false');
        $this->assertFalse($user->getLastname() === 'false');
        $this->assertFalse($user->getFirstname() === 'false');
        $this->assertFalse($user->getCompany() === 'false');
        $this->assertFalse($user->getAddress() === new Address());
        $this->assertFalse($user->getFile() === 'false');
        $this->assertFalse($user->getUpdatedAt() === new \DateTimeImmutable());
        $this->assertFalse($user->getProfessional() === false);
    }

    public function testIsEmpty()
    {
        $user = new User();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getUsername());
        $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getCompany());
        $this->assertEmpty($user->getAddress());
        $this->assertEmpty($user->getId());
        $this->assertEmpty($user->getProfessional());
    }

    public function testAddGetRemoveProperty()
    {
        $user = new User();
        $property = new Property();

        $this->assertEmpty($user->getProperties());

        $user->addProperty($property);
        $this->assertContains($property, $user->getProperties());

        $user->removeProperty($property);
        $this->assertEmpty($user->getProperties());
    }

    public function testAddGetRemoveThread()
    {
        $user = new User();
        $thread = new Thread();

        $this->assertEmpty($user->getThreads());

        $user->addThread($thread);
        $this->assertContains($thread, $user->getThreads());

        $user->removeThread($thread);
        $this->assertEmpty($user->getThreads());
    }

    public function testAddGetRemoveSent()
    {
        $user = new User();
        $sent = new Message();

        $this->assertEmpty($user->getSent());

        $user->addSent($sent);
        $this->assertContains($sent, $user->getSent());

        $user->removeSent($sent);
        $this->assertEmpty($user->getSent());
    }

    public function testAddGetRemoveReceived()
    {
        $user = new User();
        $received = new Message();

        $this->assertEmpty($user->getReceived());

        $user->addReceived($received);
        $this->assertContains($received, $user->getReceived());

        $user->removeReceived($received);
        $this->assertEmpty($user->getReceived());
    }

}
