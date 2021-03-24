<?php

namespace App\Controller;

use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class RoleController extends AbstractController
{
    /**
     * @Route("/roles", name="role.show", methods={"Get"})
     */
    public function index(RoleRepository $roleRepo)
    {
        $user = $this->getUser();
        $roleUser = $user->getRole()->getLibelle();
        if($roleUser==='ROLE_ADMIN_SYSTEM') {
            $roles = $roleRepo->adminSysShowRoles();        }
        elseif($roleUser==='ROLE_ADMIN') {
            $roles = $roleRepo->adminShowRoles();
        }elseif($roleUser==='ROLE_PARTENAIRE') {
            $roles = $roleRepo->partenaireShowRoles();
        }elseif($roleUser==='ROLE_ADMIN_PARTENAIRE') {
            $roles = $roleRepo->adminPSRoles()();
        }else{
        throw new Exception('vous ne pouvez pas lister de role',500);
        }
        return $this->json($roles , 200, [],['groups'=> 'post:read']);
    }
}
