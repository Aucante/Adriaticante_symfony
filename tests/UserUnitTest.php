<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();

        $user->setEmail('mail@test.com')
             ->setPassword('password')
             ->setUsername('username')
             ->setLastname('lastname')
             ->setFirstname('firstname')
             ->setCompany('company');

        $this->assertTrue($user->getEmail() === 'mail@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getUsername() === 'username');
        $this->assertTrue($user->getLastname() === 'lastname');
        $this->assertTrue($user->getFirstname() === 'firstname');
        $this->assertTrue($user->getCompany() === 'company');

    }

    public function testIsFalse()
    {
        $user = new User();

        $user->setEmail('true@test.com')
             ->setPassword('true')
             ->setUsername('true')
             ->setLastname('true')
             ->setFirstname('true')
             ->setCompany('true');

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getUsername() === 'false');
        $this->assertFalse($user->getLastname() === 'false');
        $this->assertFalse($user->getFirstname() === 'false');
        $this->assertFalse($user->getCompany() === 'false');
    }

    public function testIsEmpty()
    {
        $user = new User();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getUsername());
        $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getCompany());
    }

}
