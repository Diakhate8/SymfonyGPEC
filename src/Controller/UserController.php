<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Utule\FormatedDate;
use Psr\Log\LoggerInterface;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use EasyCorp\Bundle\EasyAdminBundle\Exception\EntityNotFoundException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @IsGranted({"ROLE_ADMIN","ROLE_ADMIN_SYSTEM"}, statusCode=404,
 * message=" Access refuser ")
 * @Route("/api")
 */
class UserController extends AbstractController
{  
    private $logger;

	private $userRepo;

	public function __construct(LoggerInterface $logger, UserRepository $userRepo) {
		$this->logger = $logger;
		$this->userRepo = $userRepo;
	}


    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/addusers", name="user.new", methods={"Post"})
     */
    public function addUser(Request $request,FormatedDate $formDate, EntityManagerInterface $em, 
    ValidatorInterface $validator,UserPasswordEncoderInterface $userPasswordEncoder   ) 
    { 
        $user = $this->getUser();   $roleUser = $user->getRoles()[0];
            // dd($userOnline);ok
            $message="Acces refuser veuillez contacter votre administrateur";
            // $productDeserialized = $serializer->deserialize($jsonRecu, User::class, 'json');ok
            $donneeRecu = json_decode($request->getContent());
            $roleRepo=$this->getDoctrine()->getRepository(Role::class);
            $role = $roleRepo->findOneBy(array("id"=>$donneeRecu->role ));
        if($roleUser==='ROLE_ADMIN_SYSTEM' && $role->getLibelle()==='ROLE_ADMIN_SYSTEM'){
            throw new Exception($message);
        }elseif($roleUser==='ROLE_ADMIN' && $role->getLibelle()==='ROLE_ADMIN_SYSTEM' ){
            throw new Exception("Vous ne pouvez pas ajouter d'administrateur");
        }elseif($roleUser==='ROLE_ADMIN' && $role->getLibelle()==='ROLE_ADMIN' ){
            throw new Exception("Vous ne ouvez pas ajouter d'administrateur");
        }elseif($roleUser==='ROLE_ASSISTANT'){
            throw new Exception("Acces non autorisé");
        }else {          
            try {
                    $user = new User();
                    $user->setRole($role);
                    $user->setPrenom($donneeRecu->prenom)
                         ->setNom($donneeRecu->nom);
                    $user->setTelephone($donneeRecu->telephone);
                    $user->setEmail(trim($donneeRecu->email))
                        ->setUsername($donneeRecu->username)
                        ->setPassword($userPasswordEncoder->encodePassword($user, $donneeRecu->password)) 
                        ->setRole($role); 

                    $em->persist($user);

                        $errors=$validator->validate($user)  ;
                        if(count($errors)>0){
                            return $this->json($errors,400);
                        }
                        // dd($user);ok
                    $em->flush();
                    $data= ["status" => 201, "message" => " Utulisateur $donneeRecu->username Cree avec succes"];
                                return new JsonResponse($data, 201);                        
                } catch (NotEncodableValueException $e) {
                    return $this->json([
                        'status'=>400,
                        'message'=> $e->getMessage()
                    ], 400) ; 
                    // return new Response('Vous n\'etes pas autoriser à afficher des ulisateurs', 
                    // 403, ['Content-Type' => 'application/json']);     
                }                    
                
        } 
      
    }


    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/showusers", name="user.show", methods={"Get"})
     */
    public function showUser(RoleRepository $roleRepo,Security $securite,SerializerInterface $serializer)
    {   
        $user = $this->getUser();
        $roleUser = $user->getRoles()[0];//tab roles

        if($roleUser==='ROLE_ADMIN_SYSTEM') { 
            $users = $this->userRepo->adminsysShowUsers();
        }
        elseif($roleUser==='ROLE_ADMIN'){
            $users = $this->userRepo->adminShowUser();
        }
        else{
            return new Response('Vous n\'etes pas autoriser à afficher des ulisateurs', 
            403, ['Content-Type' => 'application/json']);
        }
       // $data = $serializer->serialize($users,'json');ok
        //return new Response($data , 200, ['Content-Type'=>'application/json']);ok
        return $this->json($users , 200, [],['groups'=> 'post:read']);

    }





}

