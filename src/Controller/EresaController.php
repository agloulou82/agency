<?php

namespace App\Controller;

use App\Entity\Eresa;
use App\Entity\User;
use App\Handler\EresaHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EresaController
 * @package App\Controller
 * @Route("/reservations", name="eresa_")
 * @Template(template="eresa/")
 */
class EresaController extends AbstractController
{
    /**
     * @param EresaHandler $eresaHandler
     * @IsGranted("ROLE_ADMIN")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("", name="index")
     */
    public function index(EresaHandler  $eresaHandler)
    {
        return $this->render("eresa/index.html.twig", [
            'AllReservations' => $this->getDoctrine()->getRepository(Eresa::class)->findByUser($this->getUser())
        ]);
    }
}
