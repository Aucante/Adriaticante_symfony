<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    /**
     * @return Message[]
     */
    public function findSenderMessage($sender): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->andWhere('t.sender = :sender')
            ->setParameter('sender', $sender)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Message[]
     */
    public function findSenderThreadNotRead($sender): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->andWhere('t.sender = :sender')
            ->andWhere('t.isRead = 0')
            ->setParameter('sender', $sender)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Message[]
     */
    public function findSenderMessageNotRead($sender): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC')
            ->andWhere('m.sender = :sender')
            ->andWhere('m.isRead = 0')
            ->setParameter('sender', $sender)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Message[]
     */
    public function findRecipientMessageNotRead($recipient): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC')
            ->andWhere('m.recipient = :recipient')
            ->andWhere('m.isRead = 0')
            ->setParameter('recipient', $recipient)
            ->getQuery()
            ->getResult();
    }


    public function updateRecipientMessageNotRead($thread, $recipient): int
    {
        return $this->createQueryBuilder('m')
            ->update()
            ->set('m.isRead', 1)
            ->andWhere('m.recipient = :recipient')
            ->andWhere('m.isRead = 0')
            ->andWhere('m.thread = :thread')
            ->setParameter('recipient', $recipient)
            ->setParameter('thread', $thread)
            ->getQuery()
            ->getResult();
    }
}
