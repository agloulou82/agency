<?php
/**
 * Created by PhpStorm.
 * User: agloulou
 * Date: 07/09/18
 * Time: 15:22
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route(path="", name="homepage")
     */
    public function index()
    {
        return $this->redirectToRoute('offer_index');
    }
}
