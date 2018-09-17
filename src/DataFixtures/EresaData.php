<?php

namespace App\DataFixtures;

use App\Entity\Eresa;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EresaData extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $reservation = new Eresa();
        $reservation->setUser($this->getReference(UserData::USER_REFERENCE));
        $reservation->setOffer($this->getReference(OfferData::OFFER_REFERENCE));

        $manager->persist($reservation);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserData::class,
            OfferData::class
        ];
    }
}
