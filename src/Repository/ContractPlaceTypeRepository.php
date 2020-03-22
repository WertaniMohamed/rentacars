<?php

namespace App\Repository;

use App\Entity\ContractPlaceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractPlaceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractPlaceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractPlaceType[]    findAll()
 * @method ContractPlaceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractPlaceTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractPlaceType::class);
    }

    // /**
    //  * @return ContractPlaceType[] Returns an array of ContractPlaceType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContractPlaceType
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
