<?php

namespace App\DataFixtures;

use App\Entity\News;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slug = new Slugify();

        for ($i = 1; $i <= 35; $i++) {
           $new = new News();
           $title = $faker->word($faker->numberBetween(3,5, true));
           $new->setTitle($title)
               ->setContent($faker->paragraphs(1, true))
               ->setContentLong($faker->paragraphs(3,true))
               ->setImageName($i. '.png')
               ->setSlug($slug->slugify($title))
               ->setIsPublished($faker->boolean(90))
               ->setCreatedAt(new \DateTimeImmutable())
               ->setUpdatedAt(new \DateTimeImmutable());
           $manager->persist($new);
        }

        $manager->flush();
    }
}
