<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Faker;


class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {}
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admindemo@demo.fr');
        $admin->setLastname('CHAU');
        $admin->setFirstname('Thomas');
        $admin->setAddress('12 rue des Champs');
        $admin->setZipcode('44000');
        $admin->setCity('Nantes');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        $faker = Faker\Factory::create('fr_FR');

        for($usr=1; $usr<=5; $usr++){

            $user = new User();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setZipcode(str_replace(' ', '', $faker->postcode));
            $user->setCity($faker->city);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user,"secret")
            );

            $manager->persist($user);
        }

        $manager->flush();
    }
}
