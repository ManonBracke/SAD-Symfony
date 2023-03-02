<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
   public function __construct(UserPasswordHasherInterface $hasher)
   {
      $this->hasher = $hasher;
   }

   public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slug = new Slugify();
        $role = $manager->getRepository(Role::class)->findAll();
        $nbRoles = count($role);

        for($i =0 ; $i <=50; $i++){
           $user = new User();
           $user->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setUsername($slug->slugify($user->getFirstname(). '.' . $slug->slugify($user->getLastname())))
                ->setEmail($slug->slugify($user->getFirstname(). '.' . $slug->slugify($user->getLastname())). '.'. $faker->numberBetween(1000,9999) .'@'. $faker->freeEmailDomain())
                ->setPassword($this->hasher->hashPassword($user, 'password'))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setBirthday($faker->dateTime())
                ->setIsDesactivated($faker->boolean(10))
                ->setRole($role[$faker->numberBetween(0, $nbRoles-1)]);
           $manager->persist($user);
        }

        $manager->flush();
    }
}
