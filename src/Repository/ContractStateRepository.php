<?php

namespace App\Repository;

use App\Entity\ContractState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractState|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractState|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractState[]    findAll()
 * @method ContractState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractState::class);
    }

    // /**
    //  * @return ContractState[] Returns an array of ContractState objects
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
    public function findOneBySomeField($value): ?ContractState
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
