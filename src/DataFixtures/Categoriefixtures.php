<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategorieFixtures extends Fixture
{
    private $counter = 1;

    public function load(ObjectManager $manager): void
    {
        $parent = new Categorie() ;
        $parent->setName('Informatique');
        
        $manager->persist($parent);

        $category = new Categorie();
        $category->setName('Ordinateur');
        $category->setParent($parent);

        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;
        
        $manager->flush();
    }

    // public function createCategory(string $name, Categorie $parent = null, ObjectManager $manager){
    //     $category = new Categorie();
    //     $category->setName($name);
    //     $category->setParent($parent);
    //     $manager->persist($category);

    //     $this->addReference('cat-'.$this->counter, $category);
    //     $this->counter++;
    // }
}
