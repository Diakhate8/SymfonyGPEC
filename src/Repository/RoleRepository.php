<?php

namespace App\Repository;

use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

     /**
      * @return Role[] Returns an array of Role objects
      */
    public function adminSysShowRoles()
    {
        return $this->createQueryBuilder('r')
            ->Where('r.libelle IN (\'ROLE_ADMIN\',\'ROLE_ASSISTANT\') ')
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Role[] Returns an array of Role objects
     */
    public function adminShowRoles()
    {
        return $this->createQueryBuilder('r')
            ->Where('r.libelle IN (\'ROLE_ASSISTANT\') ')
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

   
    

    
}
