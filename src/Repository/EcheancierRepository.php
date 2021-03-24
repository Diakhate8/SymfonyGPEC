<?php

namespace App\Repository;

use App\Entity\Echeancier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Echeancier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Echeancier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Echeancier[]    findAll()
 * @method Echeancier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcheancierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Echeancier::class);
    }

    // /**
    //  * @return Echeancier[] Returns an array of Echeancier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Echeancier
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
