<?php

namespace App\Repository;

use App\Entity\ContractOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractOption[]    findAll()
 * @method ContractOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractOption::class);
    }

    // /**
    //  * @return ContractOption[] Returns an array of ContractOption objects
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
    public function findOneBySomeField($value): ?ContractOption
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
