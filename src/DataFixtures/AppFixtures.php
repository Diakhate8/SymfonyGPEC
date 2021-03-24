<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $role_admin_system = new Role();
        $role_admin_system->setLibelle("ROLE_ADMIN_SYSTEM");
        $manager->persist($role_admin_system);

        $role_admin = new Role();
        $role_admin->setLibelle("ROLE_ADMIN");
        $manager->persist($role_admin);

        $role_assistant = new Role();
        $role_assistant->setLibelle("ROLE_ASSISTANT");
        $manager->persist($role_assistant);

        $this->addReference('role_admin_system',$role_admin_system);        
        $roleAdmdinSystem = $this->getReference('role_admin_system');

        $user1 = new User();
        $user1->setUsername("AdminSys");
        $user1->setRole($roleAdmdinSystem);
        $user1->setPassword($this->encoder->encodePassword($user1, "adminsys"));
        $user1->setPrenom("Ibou");
        $user1->setNom("Diakhate");
        $user1->setTelephone(777744555);
        $user1->setEmail("Diak1@gmail.com");
        //var_dump($user1->getRoles());die();
       //$user1->setIsActive("active");
    //    dd($user1);
        $manager->persist($user1);    
        
        $manager->flush();
        
    }
}