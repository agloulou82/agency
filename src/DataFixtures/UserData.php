<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserData extends Fixture
{
    private $encoder;

    public const USER_REFERENCE = "admin";

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->getUsers() as [$username, $password]) {
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $manager->persist($user);

            $this->addReference($username, $user);
        }

        $manager->flush();


    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return
            [
                [
                    'admin',
                    'pass-1234',
                ],
                [
                    'anis',
                    'pass-1234',
                ],

            ];
    }
}
