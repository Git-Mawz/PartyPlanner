<?php

namespace App\Controller;

use App\Entity\Party;
use App\Form\PartyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartyController extends AbstractController
{
    #[Route('/party', name: 'party_browse')]
    public function browse(): Response
    {
        return $this->render('planner/index.html.twig', [
        ]);
    }

    #[Route('/party/add', name: 'party_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {

        $party = new Party();
        $form = $this->createForm(PartyType::class, $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les values

            // On set les values

            // On sauvegarde
            $entityManager->persist($party);
            $entityManager->flush();

        }

        return $this->render('party/add.html.twig', [
            'partyForm' => $form->createView(),
        ]);
    }

}
