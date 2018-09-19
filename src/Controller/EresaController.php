<?php

namespace App\Controller;

use App\Entity\Eresa;
use App\Entity\User;
use App\Handler\EresaHandler;
use http\Env\Response;
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
     * @IsGranted("ROLE_ADMIN")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("", name="index")
     */
    public function index()
    {
        return $this->redirectToRoute("eresa_list");
    }


    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/list", name="list")
     */
    public function list()
    {
        $reservations = $this->getDoctrine()->getRepository(Eresa::class)->findByUser($this->getUser());
        return $this->render('eresa/list.html.twig', ['reservations' =>$reservations]);

    }
}
