<?php

namespace App\Repository;

use App\Entity\Thread;
use App\Entity\User;
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
    public function findThreadAsSender(User $sender): array
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
    public function findThreadAsRecipient(User $recipient): array
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.property', 'p')
            ->orderBy('t.id', 'DESC')
            ->andWhere('p.user = :recipient')
            ->setParameter('recipient', $recipient)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Thread[]
     */
    public function findSenderAndRecipientThread($user): array
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.property', 'p')
            ->orderBy('t.id', 'DESC')
            ->andWhere('p.user = :user')
            ->orWhere('t.sender = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Thread[]
     */
    public function findThreadNotRead($user): array
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.property', 'p')
            ->innerJoin('t.messages', 'm')
            ->orderBy('t.id', 'DESC')
            ->andWhere('t.sender = :user')
            ->orWhere('p.user = :user')
            ->andWhere('m.isRead = 0')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Thread|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findThreadWithTheseSenderAndRecipient(User $sender, int $idProperty): ?Thread
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.property', 'p')
            ->where('t.sender = :sender')
            ->andWhere('p.id = :idProperty')
            ->setParameter('sender', $sender)
            ->setParameter('idProperty', $idProperty)
            ->getQuery()
            ->getOneOrNullResult();
    }


}
