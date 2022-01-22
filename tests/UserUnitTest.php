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
             ->setPhone('phone');

        $this->assertTrue($user->getEmail() === 'mail@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getPhone() === 'phone');

    }
}
