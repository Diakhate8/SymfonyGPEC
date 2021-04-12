<?php

namespace App\Controller;

use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/api")
 */
class ShowContratController extends AbstractController
{
    /**
     * @Route("/show/contrat", name="show_contrat")
     */
    public function index()
    {
        return $this->render('show_contrat/index.html.twig', [
            'controller_name' => 'ShowContratController',
        ]);
    }

    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/showventes", name="ventes.show", methods={"Get"})
     */
    public function showVente( ContratRepository $contratRepo, SerializerInterface $serializerInt)
    {
        $userOnline = $this->getUser();
        $idUser = $userOnline->getId(); $roleUser =  $userOnline->getRoles()[0];
        // dd($userOnline);ok
        if($roleUser==='ROLE_ADMIN_SYSTEM'){
            $vente=$contratRepo->AdminSysfindVentes();
        }
        if($roleUser==='ROLE_ADMIN'|| $roleUser==='ROLE_ASSISTANT'){
            $vente=$contratRepo->AdminFindVentes($idUser);
        }
        // dd($vente);
        //$ventes = $serializerInt->serialize($vente,'json');
        // return new Response($ventes , 200, ['Content-Type'=>'application/json']);
       // return new Response($ventes, 200,['content-Type'=> 'application/json' ]);   
        $ventes =$serializerInt->serialize($vente,'json',['groups'=>'get:contrat']);
        // dd($ventes);
        //return $this->json($ventes , 200, [],['groups'=> 'get:vente']);
        return new Response($ventes , 200,['content-Type'=> 'application/json']);
    }
}
