<?php

namespace App\Handler;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserHandler
{

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(
        ObjectManager $objectManager,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->objectManager = $objectManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function save(array $userData)
    {
        $user = (new User)
            ->setUsername($userData['username']);

        $user->setPassword(
            $this->userPasswordEncoder->encodePassword($user, $userData['password'])
        );


        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }

    public function findAll(): array
    {
        return $this->objectManager->getRepository('App:User')->findAll();
    }
}
