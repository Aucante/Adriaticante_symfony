<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }



    /**
     * @return Property[]
     */
    public function lastThree(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Property[]
     */
    public function findUserProperties($user): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->andWhere('p.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * Call properties with filter
     * @return Property[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('p');

        if (!empty($search->q))
        {
            $query = $query
                ->andWhere('p.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->priceMin))
        {
            $query = $query
                ->andWhere('p.price >= :min')
                ->setParameter('min', $search->priceMin);
        }

        if (!empty($search->priceMax))
        {
            $query = $query
                ->andWhere('p.price <= :max')
                ->setParameter('max', $search->priceMax);
        }

        if (!empty($search->areaMin))
        {
            $query = $query
                ->andWhere('p.area >= :min')
                ->setParameter('min', $search->areaMin);
        }

        if (!empty($search->areaMax))
        {
            $query = $query
                ->andWhere('p.area <= :max')
                ->setParameter('max', $search->areaMax);
        }

        if (!empty($search->roomsMin))
        {
            $query = $query
                ->andWhere('p.totalRooms >= :min')
                ->setParameter('min', $search->roomsMin);
        }

        if (!empty($search->roomsMax))
        {
            $query = $query
                ->andWhere('p.totalRooms <= :max')
                ->setParameter('max', $search->roomsMax);
        }

        if (!empty($search->bedroomsMin))
        {
            $query = $query
                ->andWhere('p.totalBedrooms >= :min')
                ->setParameter('min', $search->bedroomsMin);
        }

        if (!empty($search->bedroomsMax))
        {
            $query = $query
                ->andWhere('p.totalBedrooms <= :max')
                ->setParameter('max', $search->bedroomsMax);
        }

        if (!empty($search->bathroomsMin))
        {
            $query = $query
                ->andWhere('p.totalBathrooms >= :min')
                ->setParameter('min', $search->bathroomsMin);
        }

        if (!empty($search->bathroomsMax))
        {
            $query = $query
                ->andWhere('p.totalBathrooms <= :max')
                ->setParameter('max', $search->bathroomsMax);
        }

        return $query->getQuery()->getResult();
    }
}
