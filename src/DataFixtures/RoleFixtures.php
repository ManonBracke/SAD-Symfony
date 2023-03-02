<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public array $roles =['Admin', 'Modérateur', 'Support', 'Joueur'];

    public function load(ObjectManager $manager): void
    {

        foreach ($this->roles as $data){
           $role= new Role();
           $role->setName($data)
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setCreatedAt(new \DateTimeImmutable());
        }

        $manager->flush();
    }
}
