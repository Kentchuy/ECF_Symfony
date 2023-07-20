<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class Categoriefixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $parent = new Categorie ;
        $parent->setName('Informatique');

        $manager->persist($parent);
        $manager->flush();


        $category = new Categorie();
        $category->setName('Ordinateur');

        $category->setParent($parent);

        $manager->persist($category);
        $manager->flush();
    }
}
