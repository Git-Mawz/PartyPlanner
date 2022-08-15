<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\User;
use App\Form\CharacterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profil', name: 'user_profil')]
    public function index(): Response
    {
        $userCharacters = $this->getUser()->getCharacters();

        return $this->render('user/profil.html.twig', [
            'userCharacters' => $userCharacters
        ]);
    }


    #[Route('/profil/character/add', name: 'profil_character_add')]
    public function addCharacter(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $character = new Character();
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les données du formulaire
            $characterName = $form->getData()->getName();
            // On check si le personnage n'existe pas déjà sur ce jeu
            $alreadyExistingCharacter = $doctrine->getRepository(Character::class)->findOneBy(['name' => $characterName]);
            

            // Si le nom du peprsonnage est déjà présent on redirige vers le profil en indiquant que le personnage existe déjà
            if ($alreadyExistingCharacter instanceof Character) {
                $this->addFlash('warning', 'Character already exist');
                return $this->redirectToRoute('user_profil');
            }

            // TODO On prévois le check en cas de serveur de jeu différents

            // On set le current user au personnage
            $character->setUser($this->getUser());
            $entityManager->persist($character);
            $entityManager->flush();

            return $this->redirectToRoute('user_profil');

        }

        return $this->render('user/character_add.html.twig', [
            'characterForm' => $form->createView(),
        ]);
    }

}
