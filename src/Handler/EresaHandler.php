<?php

namespace App\Handler;

use App\Entity\Eresa;
use App\Entity\Offer;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class EresaHandler
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param Offer $offer
     * @param User $user
     */
    public function addBy(Offer $offer, User $user)
    {
        $eresa = (new Eresa())
            ->setOffer($offer)
            ->setUser($user);

        $this->objectManager->persist($eresa);
        $this->objectManager->flush();
    }
}
