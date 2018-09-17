<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OfferData extends Fixture
{
    public const OFFER_REFERENCE ="Offer 1";
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getOfferData() as [$title,
                 $intro,
                 $desc,
                 $dateExpire,
                 $enable]
        ) {
            $offer = new Offer();
            $offer->setTitle($title);
            $offer->setIntroduction($intro);
            $offer->setDescription($desc);
            $offer->setExpiresAt($dateExpire);
            $offer->setIsActivated($enable);

            $manager->persist($offer);

            $this->addReference($title, $offer);

       };


        $manager->flush();
    }

    /**
     * @return array
     */
    public function getOfferData(): array
    {

        $offers = [];
        for ($i = 1; $i <10; $i++)
        {
            $offers [] = [
                'Offer '.$i,
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ...',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.',
                new \DateTime("2019-10-10"),
                true];
        }
        return $offers;

    }
}
