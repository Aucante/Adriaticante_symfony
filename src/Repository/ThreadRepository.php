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
            ->innerJoin('t.property', 'p')
            // Recuperate messages not read
            ->leftJoin('t.messages', 'm', 'WITH', 'm.isRead = 0 AND m.recipient = :sender')
            ->leftJoin('t.messages', 'm2')
            ->addSelect('case when COUNT(m) > 0 then 1 else 0 end')
            ->addSelect('MAX(m2.createdAt)')
            ->groupBy('t')
            ->addOrderBy('case when COUNT(m) > 0 then 1 else 0 end', 'DESC')
            ->addOrderBy('MAX(m2.createdAt)', 'DESC')
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
            // Recuperate messages not read
            ->leftJoin('t.messages', 'm', 'WITH', 'm.isRead = 0 AND m.recipient = :recipient')
            ->leftJoin('t.messages', 'm2')
            ->addSelect('case when COUNT(m) > 0 then 1 else 0 end')
            ->addSelect('MAX(m2.createdAt)')
            ->groupBy('t')
            ->addOrderBy('case when COUNT(m) > 0 then 1 else 0 end', 'DESC')
            ->addOrderBy('MAX(m2.createdAt)', 'DESC')
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
            // Recuperate messages not read
            ->leftJoin('t.messages', 'm', 'WITH', 'm.isRead = 0 AND m.recipient = :user')
            ->leftJoin('t.messages', 'm2')
            ->addSelect('case when COUNT(m) > 0 then 1 else 0 end')
            ->addSelect('MAX(m2.createdAt)')
            ->groupBy('t')
            ->addOrderBy('case when COUNT(m) > 0 then 1 else 0 end', 'DESC')
            ->addOrderBy('MAX(m2.createdAt)', 'DESC')
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
            ->leftJoin('t.messages', 'm', 'WITH', 'm.isRead = 0 AND m.recipient = :user')
            ->addSelect('case when COUNT(m) > 0 then 1 else 0 end')
            ->orderBy('t.id', 'DESC')
            ->groupBy('t')
            ->addOrderBy('case when COUNT(m) > 0 then 1 else 0 end', 'DESC')
            ->andWhere('t.sender = :user')
            ->orWhere('p.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
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
