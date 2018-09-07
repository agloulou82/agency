<?php

namespace App\Handler;

use App\Entity\Eresa;
use App\Entity\Offer;
use App\Entity\User;
use App\Model\EresaModel;
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
     * @param EresaModel $eresaModel
     * @param Offer $offer
     * @param User $user
     */
    public function addBy(EresaModel $eresaModel, Offer $offer, User $user)
    {
        $eresa = (new Eresa())
            ->setOffer($offer)
            ->setUser($user)
            ->setIsActivated($eresaModel->isActivated);

        $this->objectManager->persist($eresa);
        $this->objectManager->flush();
    }
}
