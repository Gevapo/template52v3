<?php

namespace App\Repository;

use App\Entity\Adressoort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adressoort|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adressoort|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adressoort[]    findAll()
 * @method Adressoort[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdressoortRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adressoort::class);
    }

    // /**
    //  * @return Adressoort[] Returns an array of Adressoort objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adressoort
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
