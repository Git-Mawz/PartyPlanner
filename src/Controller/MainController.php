<?php

namespace App\Controller;

use App\Entity\Party;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(ManagerRegistry $doctrine): Response
    {

        $parties = $doctrine->getRepository(Party::class)->findByHappenDateDesc();

        return $this->render('main/home.html.twig', [
            'parties' => $parties
        ]);
    }
    
}
