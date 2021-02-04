<?php

namespace App\Repository;

use App\Entity\CartOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartOption[]    findAll()
 * @method CartOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartOption::class);
    }

    // /**
    //  * @return CartOption[] Returns an array of CartOption objects
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
    public function findOneBySomeField($value): ?CartOption
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
