<?php

namespace App\Repository;

use App\Entity\Thread;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Thread|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thread|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thread[]    findAll()
 * @method Thread[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThreadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thread::class);
    }

    /**
     * @return Thread[]
     */
    public function findSenderThread($sender): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->andWhere('t.sender = :sender')
            ->setParameter('sender', $sender)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Thread[]
     */
    public function findRecipientThread($recipient): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->andWhere('t.recipient = :recipient')
            ->setParameter('recipient', $recipient)
            ->getQuery()
            ->getResult();
    }





}
