<?php
/**
 * Created by PhpStorm.
 * UserModel: agloulou
 * Date: 05/09/18
 * Time: 10:03
 */

namespace App\Handler;

use App\Entity\Offer;
use Doctrine\Common\Persistence\ObjectManager;

class OfferHandler
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
}
