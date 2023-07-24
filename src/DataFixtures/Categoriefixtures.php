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
        $parent = $this->createCategory('Informatique', null, $manager);
        
        $this->createCategory('Ordinateurs portables', $parent, $manager);
        $this->createCategory('Ecrans', $parent, $manager);
        $this->createCategory('Souris', $parent, $manager);

        $parent = $this->createCategory('Mode', null, $manager);

        $this->createCategory('Homme', $parent, $manager);
        $this->createCategory('Femme', $parent, $manager);
        $this->createCategory('Enfant', $parent, $manager);
                
        $manager->flush();
    }

    public function createCategory(string $name, Categorie $parent = null, ObjectManager $manager){
        $category = new Categorie();
        $category->setName($name);
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}


    // public function load(ObjectManager $manager): void
    // {
    //     $parent = new Categorie() ;
    //     $parent->setName('Informatique');
        
    //     $manager->persist($parent);

    //     $category = new Categorie();
    //     $category->setName('Ordinateur');
    //     $category->setParent($parent);

    //     $manager->persist($category);
        
    //     $manager->flush();
    // }
