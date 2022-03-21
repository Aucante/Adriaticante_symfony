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
     * Call property with filter
     * @return Property[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('f', 'p')
            ->join('p.features', 'f');

        if (!empty($search->q))
        {
            $query = $query
                ->andWhere('p.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->priceMin))
        {
            $query = $query
                ->andWhere('p.price >= :minPrice')
                ->setParameter('minPrice', $search->priceMin);
        }

        if (!empty($search->priceMax))
        {
            $query = $query
                ->andWhere('p.price <= :maxPrice')
                ->setParameter('maxPrice', $search->priceMax);
        }

        if (!empty($search->areaMin))
        {
            $query = $query
                ->andWhere('p.area >= :minArea')
                ->setParameter('minArea', $search->areaMin);
        }

        if (!empty($search->areaMax))
        {
            $query = $query
                ->andWhere('p.area <= :maxArea')
                ->setParameter('maxArea', $search->areaMax);
        }

        if (!empty($search->roomsMin))
        {
            $query = $query
                ->andWhere('p.totalRooms >= :minRoom')
                ->setParameter('minRoom', $search->roomsMin);
        }

        if (!empty($search->roomsMax))
        {
            $query = $query
                ->andWhere('p.totalRooms <= :maxRoom')
                ->setParameter('maxRoom', $search->roomsMax);
        }

        if (!empty($search->bedroomsMin))
        {
            $query = $query
                ->andWhere('p.totalBedrooms >= :minBedroom')
                ->setParameter('minBedroom', $search->bedroomsMin);
        }

        if (!empty($search->bedroomsMax))
        {
            $query = $query
                ->andWhere('p.totalBedrooms <= :maxBedroom')
                ->setParameter('maxBedroom', $search->bedroomsMax);
        }

        if (!empty($search->bathroomsMin))
        {
            $query = $query
                ->andWhere('p.totalBathrooms >= :minBathroom')
                ->setParameter('minBathroom', $search->bathroomsMin);
        }

        if (!empty($search->bathroomsMax))
        {
            $query = $query
                ->andWhere('p.totalBathrooms >= :maxBathroom')
                ->setParameter('maxBathroom', $search->bathroomsMax);
        }

        if (!empty($search->type))
        {
            $query = $query
                ->andWhere('p.type LIKE :type')
                ->setParameter('type', "%{$search->type}%");
        }

        if (!empty($search->advertType))
        {
            $query = $query
                ->andWhere('p.name LIKE :advertType')
                ->setParameter('advertType', "%{$search->advertType}%");
        }

        if (!empty($search->city))
        {
            $query = $query
                ->andWhere('p.city = :city')
                ->setParameter('city', $search->city);
        }


        if (!empty($search->features))
        {
            $query = $query
                ->andWhere('f.id IN (:features)')
                ->setParameter('features', $search->features);
        }

        return $query->getQuery()->getResult();
    }
}
