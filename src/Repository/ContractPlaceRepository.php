<?php

namespace App\Repository;

use App\Entity\ContractPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractPlace[]    findAll()
 * @method ContractPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractPlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractPlace::class);
    }

    // /**
    //  * @return ContractPlace[] Returns an array of ContractPlace objects
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
    public function findOneBySomeField($value): ?ContractPlace
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
