<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OfferData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $first = new Offer();
        $first->setTitle('Offer 1');
        $first->setIntroduction("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ...");
        $first->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.");
        $first->setExpiresAt(new \DateTime("2019-10-10"));
        $first->setIsActivated(true);

        $manager->persist($first);

        $next = new Offer();
        $next->setTitle('Offer 2');
        $next->setIntroduction("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ...");
        $next->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.");
        $next->setExpiresAt(new \DateTime("2019-10-10"));
        $next->setIsActivated(true);

        $manager->persist($next);

        $end = new Offer();
        $end->setTitle('Offer 3');
        $end->setIntroduction("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ...");
        $end->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.");
        $end->setExpiresAt(new \DateTime("2019-10-10"));
        $end->setIsActivated(true);

        $manager->persist($end);

        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}
