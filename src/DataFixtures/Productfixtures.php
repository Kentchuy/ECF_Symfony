<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Faker;
use Monolog\DateTimeImmutable;

class Productfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for( $prod =1; $prod <=10; $prod++){

            $product = new Product();
            $product->setName($faker->text(15));
            $product->setDescription($faker->text());
            $product->setPrice($faker->numberBetween(900, 150000));
            $product->setStock($faker->numberBetween(0, 10));
            $product->setCreatedAt(new DateTimeImmutable('Y-m-d H:i:s'));

            // Pour chercher une référence de catégorie
            $category = $this->getReference('cat-'.rand(1, 1));
            $product->setCategories($category);

            // Créer un référence prod pour les images
            $this->setReference('prod-'.$prod, $product);
            $manager->persist($product);
        }
        $manager->flush();
    }
}
