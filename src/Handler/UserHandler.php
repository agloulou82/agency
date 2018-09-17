<?php

namespace App\Handler;

use App\Entity\User;
use App\Model\UserModel;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserHandler
{

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

    public function save(UserModel $userData)
    {
        $user = (new User)
            ->setUsername($userData->username);

        $user->setPassword(
            $this->userPasswordEncoder->encodePassword($user, $userData->password)
        );


        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }

}
