<?php

namespace App\Tests;

use App\Entity\Message;
use App\Entity\Thread;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class MessageUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $message = new Message();
        $thread = new Thread();
        $user1 = new User();
        $user2 = new User();
        $dateTime = new \DateTimeImmutable();

        $message->setMessage('true')
            ->setCreatedAt($dateTime)
            ->setIsRead(true)
            ->setThread($thread)
            ->setSender($user1)
            ->setRecipient($user2);

        $this->assertTrue($message->getMessage() === 'true');
        $this->assertTrue($message->getCreatedAt() === $dateTime);
        $this->assertTrue($message->getIsRead() === true);
        $this->assertTrue($message->getThread() === $thread);
        $this->assertTrue($message->getSender() === $user1);
        $this->assertTrue($message->getRecipient() === $user2);
    }

    public function testIsFalse()
    {
        $message = new Message();
        $thread = new Thread();
        $user1 = new User();
        $user2 = new User();
        $dateTime = new \DateTimeImmutable();

        $message->setMessage('true')
            ->setCreatedAt($dateTime)
            ->setIsRead(true)
            ->setThread($thread)
            ->setSender($user1)
            ->setRecipient($user2);

        $this->assertFalse($message->getMessage() === 'false');
        $this->assertFalse($message->getCreatedAt() === new \DateTimeImmutable());
        $this->assertFalse($message->getIsRead() === false);
        $this->assertFalse($message->getThread() === new Thread());
        $this->assertFalse($message->getSender() === $user2);
        $this->assertFalse($message->getRecipient() === $user1);
    }

    public function testIsEmpty()
    {
        $message = new Message();

        $this->assertEmpty($message->getMessage());
        $this->assertEmpty($message->getIsRead());
        $this->assertEmpty($message->getThread());
        $this->assertEmpty($message->getSender());
        $this->assertEmpty($message->getRecipient());
    }
}
