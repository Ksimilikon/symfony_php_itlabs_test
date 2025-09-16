<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminUserFixture extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ){}

    public function load(ObjectManager $manager): void
    {
        $username = 'admin';
        $password = 'foo';
        $roles = ['ROLE_ADMIN'];

        $existUser = $manager->getRepository(User::class)
            ->findOneBy(['username'=>$username]);
        if ($existUser){
            echo "AdminUserFixture::load::USER ALREADY EXIST";
            return;
        }

        $user = (new User())
            ->setUsername($username)
            ->setRoles($roles);

        $hashedPwd = $this->hasher->hashPassword($user, $password);
        $user->setPassword($hashedPwd);

        $manager->persist($user);
        $manager->flush();

        echo "AdminUserFixture::load::success";
    }
}
