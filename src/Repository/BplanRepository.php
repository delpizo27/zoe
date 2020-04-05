<?php

namespace App\Repository;

use App\Entity\Bplan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bplan|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bplan|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bplan[]    findAll()
 * @method Bplan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BplanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bplan::class);
    }

    // /**
    //  * @return Bplan[] Returns an array of Bplan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bplan
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
