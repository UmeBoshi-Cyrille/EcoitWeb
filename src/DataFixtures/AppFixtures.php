<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Category;
use App\Entity\Formation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // Category
        $categories = [];
        for ($r = 0; $r <= 10; $r++) {
            // $product = new Product();
            // $manager->persist($product);
            $category = new Category();
            $category->setTitle($this->faker->word())
                ->setDescription($this->faker->text(300));
    
            $categories[] = $category;
            $manager->persist($category);
        }

        // User
        $users = [];
        for ($i =0 ; $i < 10; $i++) {
            $user = new User();
            $user->setName($this->faker->lastName())
                ->setFirstname($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setDescription($this->faker->text(1200))
                ->setRoles(['ROLE_STUDENT'])
                ->setPlainPassword('password');

            $users[] = $user;

            $manager->persist($user);
        }

        // Category
        $formations = [];
        for ($r = 0; $r <= 10; $r++) {
            // $product = new Product();
            // $manager->persist($product);
            $formation = new Formation();
            $formation->setTitle($this->faker->word())
                ->setSentence($this->faker->text(255))
                ->setDescription($this->faker->text(1200))
                ->setCategory($category)
                ->setInstructor($user)
                ->setIsPublished(mt_rand(0, 1) == 1 ? true : false);
    
            $formations[] = $formation;
            $manager->persist($formation);
        }

        $manager->flush();
    }
}
