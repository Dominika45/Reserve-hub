<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $password) {
        $this->passwordHasher = $password;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail("admin@reservehub.pl");
        $admin->setFirstName("Admin");
        $admin->setLastName("Admin");
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin123')
        );
        $manager->persist($admin);

        for($i=0; $i<4; $i++) {
            $user = new User();
            $user->setEmail("user{$i}@reservehub.pl");
            $user->setFirstName("User{$i}");
            $user->setLastName("User{$i}");
            $user->setRoles(['ROLE_USER']);
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, "user{$i}")
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}
