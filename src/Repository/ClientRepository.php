<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    // /**
    //  * @return Client[] Returns an array of Client objects
    //  */
    
    public function findVentes()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT C.id, C.prenom, C.nom, Co.numContrat, Co.reference, F
                FROM  App\Entity\Client C, App\Entity\Contrat Co, App\Entity\Facture F 
                WHERE C.id = Co.client AND F.contrat = Co.id 
            ')
            ->getResult();
    }
    //                 //App\Entity\Commande Com 

    // public function Quartieractu($quartier)
        // {
        //     $qb = $this->createQueryBuilder('a')
        //                ->leftJoin('a.quartier', 'q')
        //                ->addSelect('q')
        //                ->where('q.nom = :motcle')
        //                ->setParameter('motcle', $quartier);
        //     throw new \Exception($qb->getQuery()->getSql());
    
        //     return $qb->getQuery()
        //               ->getResult();
            // }
     // /**
    //  * @return Client[] Returns an array of Client objects
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
    public function findOneBySomeField($value): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // $queryBuilder->createQueryBuilder('token')
    //          ->leftJoin('token.attToken', 'attToken')
    //          ->where('attToken.idUtilisateur IS NULL')
    //          ->orderBy('token.nomSerie', 'ASC')

     /*
    public function findOneBySomeField($value): ?Client
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
