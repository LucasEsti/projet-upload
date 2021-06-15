<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Folder;
use Nucleos\UserBundle\Model\UserManagerInterface;

class AppFixtures extends Fixture
{
    
    private $encoder;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->encoder = $userManager;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = $this->encoder->createUser();
        $user->setUsername('Lucas');
        $user->setEmail('lie.lucas.razafindrambo@esti.mg');
        $user->setPassword('');

        $this->encoder->updateUser($user);
        
        $folder = new Folder();
        $folder->setLibelle("home");
        $folder->setUser($user);
        $manager->persist($folder);

        $manager->flush();
    }
}
