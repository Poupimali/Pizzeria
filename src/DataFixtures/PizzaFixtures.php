<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PizzaFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $pizza = new Pizza();
            $faker = Faker\Factory::create('fr_FR');
            $pizza->setName(ucwords($faker->text(15)));
            $pizza->setSize($faker->numberBetween(26,33));
            $manager->persist($pizza);
            $pizza->setCategory($this->getReference('categorie_' . rand(0,3)));
            // categorie_ . rand fait reference à la premiere categorie générée.
            $manager->flush();
        }
    }
}
