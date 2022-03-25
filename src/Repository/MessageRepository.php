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
    public function findRecipientMessageNotRead($recipient): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->andWhere('t.recipient = :recipient')
            ->andWhere('t.isRead = 0')
            ->setParameter('recipient', $recipient)
            ->getQuery()
            ->getResult();
    }
}
