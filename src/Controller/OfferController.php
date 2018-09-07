<?php

namespace App\Controller;

use App\Entity\Eresa;
use App\Entity\Offer;
use App\Form\EresaType;
use App\Handler\EresaHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OfferController
 * @package App\Controller
 * @Route("/offers", name="offer_")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('offer/list.html.twig', [
            'offers' => $this->getDoctrine()->getRepository(Offer::class)->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER", subject="id")
     *
     * @param Offer $offer
     * @param EresaHandler $eresaHandler
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function show(Offer $offer, EresaHandler $eresaHandler, Request $request)
    {
        $user = $this->getUser();

        if (null === $offer) {
            throw $this->createNotFoundException('No offer found for id' . $offer->getId());
        }

        $form = $this->createForm(EresaType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->getDoctrine()->getRepository(Eresa::class)->getCountByUser($user) < Eresa::OFFER_MAX_LIMIT_BY_USER) {
                $eresaHandler->addBy($offer, $user);
                return $this->redirectToRoute('offer_list');
            }
        }


        return $this->render('offer/show.html.twig', [
            'offer' => $offer, 'form' => $form->createView(),
        ]);
    }
}
