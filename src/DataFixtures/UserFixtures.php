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
        $faker = Factory::create('fr_BE');

        for($i =0 ; $i <=56; $i++){
           $user = new User();
           $user->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setUsername(str_replace(' ','',strtolower($user->getFirstname())).'.'.str_replace(' ','',strtolower($user->getLastname())))
                ->setEmail($user->getUsername().'.'.$faker->numberBetween(1000,9999) .'@'. $faker->freeEmailDomain())
                ->setPassword($this->hasher->hashPassword($user, 'password'))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setBirthday($faker->dateTime())
                ->setIsDesactivated($faker->boolean(10))
                ->setRoles(['ROLE_USER']);
           $manager->persist($user);
        }

        $user = new User();
        $user->setFirstname('Support')
            ->setLastname('Support')
            ->setUsername('Support')
            ->setEmail($user->getUsername().'.'.$faker->numberBetween(1000,9999) .'@'. $faker->freeEmailDomain())
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setBirthday($faker->dateTime())
            ->setIsDesactivated($faker->boolean(10))
            ->setRoles(['ROLE_SUPPORT']);
        $manager->persist($user);

        $user = new User();
        $user->setFirstname('Modérateur')
            ->setLastname('Modérateur')
            ->setUsername('Modérateur')
            ->setEmail($user->getUsername().'.'.$faker->numberBetween(1000,9999) .'@'. $faker->freeEmailDomain())
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setBirthday($faker->dateTime())
            ->setIsDesactivated($faker->boolean(10))
            ->setRoles(['ROLE_MODERATOR']);
        $manager->persist($user);

        $user = new User();
        $user->setFirstname('Admin')
            ->setLastname('Admin')
            ->setUsername('Admin')
            ->setEmail($user->getUsername().'.'.$faker->numberBetween(1000,9999) .'@'. $faker->freeEmailDomain())
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setBirthday($faker->dateTime())
            ->setIsDesactivated($faker->boolean(10))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user = new User();
        $user->setFirstname('Super_Admin')
            ->setLastname('Super_Admin')
            ->setUsername('Super.Admin')
            ->setEmail($user->getUsername().'.'.$faker->numberBetween(1000,9999) .'@'. $faker->freeEmailDomain())
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setBirthday($faker->dateTime())
            ->setIsDesactivated($faker->boolean(10))
            ->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
