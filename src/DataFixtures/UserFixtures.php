<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
public const ADMIN_USER_REFERENCE = 'admin-user';
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

public function load(ObjectManager $manager)
{
$userAdmin = new User;
$userAdmin -> setUsername('admin');
$password = $this->encoder->hashPassword($userAdmin,123);
$userAdmin -> setPassword($password);
$userAdmin -> setEmail('admine-mail@medium.com');
$userAdmin -> setCreatedAt(new \DateTime('today'));
$manager->persist($userAdmin);
$manager->flush();

// other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
$this->addReference(self::ADMIN_USER_REFERENCE, $userAdmin);
}
}
