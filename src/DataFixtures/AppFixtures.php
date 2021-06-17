<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Folder;
use App\Entity\SubscriptionType;
use App\Entity\SubscriptionStatus;
use App\Entity\Categorie;
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
        //user
        $user = $this->encoder->createUser();
        $user->setUsername('Lucas');
        $user->setEmail('lie.lucas.razafindrambo@esti.mg');
        $user->setPassword('Lucas');
        $this->encoder->updateUser($user);
        
        //folder
        $folder = new Folder();
        $folder->setLibelle("home");
        $folder->setUser($user);
        $manager->persist($folder);
        
        //categorie
        $categorieLibelle = ["Antsy", "Fiara", "Akondro", "Fiara karetsaka", "Lamba", "Basy", "Very", "Masoandro"];
        for ($i = 0; $i < count($categorieLibelle); $i++) {
            $categorie = new Categorie();
            $categorie->setLibelle($categorieLibelle[$i]);
            $manager->persist($categorie);
        }
        
        //SubscriptionType
        $subscriptionTypes = ["Mensuel", "Credit", "Annuel"];
        
        for ($i = 0; $i < count($subscriptionTypes); $i++) {
            $subscriptionType = new SubscriptionType();
            $subscriptionType->setLibelle($subscriptionTypes[$i]);
            $manager->persist($subscriptionType);
        }
        
        //SubscriptionType
        $subscriptionStatus = ["Active", "Inactive"];
        
        for ($i = 0; $i < count($subscriptionStatus); $i++) {
            $subscriptionState = new SubscriptionStatus();
            $subscriptionState->setLibelle($subscriptionStatus[$i]);
            $manager->persist($subscriptionState);
        }

        $manager->flush();
    }
}
