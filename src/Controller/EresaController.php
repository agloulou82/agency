<?php

namespace App\Controller;

use App\Handler\EresaHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EresaController
 * @package App\Controller
 * @Route("/eresa", name="eresa_")
 */
class EresaController extends AbstractController
{
    /**
     * @param EresaHandler $eresaHandler
     * @IsGranted("ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("", name="index")
     */
    public function index(EresaHandler $eresaHandler)
    {
        return $this->render("eresa/index.html.twig", [
            'AllReservations' => $eresaHandler->findByUser($this->getUser())
        ]);
    }
}
