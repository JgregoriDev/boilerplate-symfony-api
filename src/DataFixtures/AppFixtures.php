<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
  
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin');
        $user->setPassword($this->passwordEncoder->hashPassword(
            $user,
            'admin'
        ));

        $manager->persist($user);
        $user = new User();
        $user->setEmail('user');
        $user->setPassword($this->passwordEncoder->hashPassword(
            $user,
            'user'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
