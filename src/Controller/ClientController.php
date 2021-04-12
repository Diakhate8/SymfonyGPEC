<?php

namespace App\Controller;

use Exception;
use App\Entity\ClientSearch;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/api")
 */
class ClientController extends AbstractController
{

    private $clientRepo;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }


    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            ]);
    }


    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN", "ROLE_ASSISTANT"}, statusCode=403,
     * message=" Access refuser veuilliez vous connecter")
     * @Route("/showclient", name="client.show", methods={"post"})
     */
    public function showClient(Request $request,SerializerInterface $serializer)
    {   
        $jsonRecu = $request->getContent();
        $donneeRecu = json_decode($jsonRecu);          
        //  dd($donneeRecu);
        if($donneeRecu->numero){
            $entityClient= $this->clientRepo->findOneBy(array("numClient"=>$donneeRecu->numero)); 
            if(!$entityClient){
                throw new Exception('Pas de client trouver');
            }       
        }else{
            throw new Exception('Veuillez saisir les informations');
        }

        return $this->json($entityClient, 200, [],['groups'=> 'post:write']);

    }

}
