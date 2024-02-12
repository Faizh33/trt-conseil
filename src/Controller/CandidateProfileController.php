<?php

namespace App\Controller;

use App\Form\CandidateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidateProfileController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/candidat/mon-profil', name: 'candidate_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(CandidateType::class, null, ['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', "Votre profil a été mis à jour avec succès.");

            return $this->redirectToRoute('login');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Il y a des erreurs dans le formulaire. Veuillez le corriger.');
        }

        return $this->render('candidate_profile.html.twig', [
            'controller_name' => 'CandidateProfileController',
            'form' => $form->createView(),
        ]);
    }
}
