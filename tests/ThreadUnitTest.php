<?php

namespace App\Tests;

use App\Entity\Message;
use App\Entity\Property;
use App\Entity\Thread;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ThreadUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $thread = new Thread();
        $property = new Property();
        $sender = new User();

        $thread->setTitle('true')
            ->setProperty($property)
            ->setSender($sender);

        $this->assertTrue($thread->getTitle() === 'true');
        $this->assertTrue($thread->getProperty() === $property);
        $this->assertTrue($thread->getSender() === $sender);
    }

    public function testIsFalse()
    {
        $thread = new Thread();
        $property = new Property();
        $sender = new User();

        $thread->setTitle('true')
            ->setProperty($property)
            ->setSender($sender);

        $this->assertFalse($thread->getTitle() === 'false');
        $this->assertFalse($thread->getProperty() === new Property());
        $this->assertFalse($thread->getSender() === new User());
    }

    public function testIsEmpty()
    {
        $thread = new Thread();

        $this->assertEmpty($thread->getId());
        $this->assertEmpty($thread->getTitle());
        $this->assertEmpty($thread->getProperty());
        $this->assertEmpty($thread->getSender());
        $this->assertEmpty($thread->getMessages());
    }

    public function testAddGetRemoveMessages()
    {
        $thread = new Thread();
        $message = new Message();

        $this->assertEmpty($thread->getMessages());

        $thread->addMessage($message);
        $this->assertContains($message, $thread->getMessages());

        $thread->removeMessage($message);
        $this->assertEmpty($thread->getMessages());
    }
}
