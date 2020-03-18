<?php

namespace App\Repository;

use App\Entity\ContractHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractHistory[]    findAll()
 * @method ContractHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractHistory::class);
    }

    // /**
    //  * @return ContractHistory[] Returns an array of ContractHistory objects
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
    public function findOneBySomeField($value): ?ContractHistory
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
