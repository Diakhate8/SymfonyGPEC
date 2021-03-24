<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/api")
 */
class StatusController extends AbstractController
{
    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/status/{id}", name="status", methods={"Get"})
     */
    public function onStatus($id, UserRepository $userRepo)
    {
        // $repo = $this->getDoctrine()->getRepository(User::class)
        $user = $userRepo->find($id);
        $mode = '';
        $userOnline = $this->getUser();
        //role user online
        $roleUser = $userOnline->getRoles()[0];

        if($roleUser==='ROLE_ADMIN_SYSTEM') { 
            $users = $userRepo->adminsysShowUsers();
        }
        elseif($roleUser==='ROLE_ADMIN'){
            $users = $userRepo->adminShowUser();
        }
        else{
            return new Response('Vous n\'etes pas autoriser à afficher des ulisateurs', 
            403, ['Content-Type' => 'application/json']);
        }
        if($user->getIsActive()===true){
            $mode = 'desactive';
            $user->setIsActive(false);
        }else{
            $mode = 'active';
            $user->setIsActive(true);
        }
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();
        $data= [
            "status" => 200,
            "message" => $user->getUsername()." est ".$mode 
        ];
        return $this->json($data, 200);
    }


    
}
