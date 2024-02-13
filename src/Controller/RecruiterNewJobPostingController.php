<?php

namespace App\Controller;

use App\Form\JobPostingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecruiterNewJobPostingController extends AbstractController
{
    #[Route('/recruteur/nouvelle-annonce', name: 'recruiter_new_jobposting')]
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(JobPostingType::class, null, ['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', "Votre profil a été mis à jour avec succès.");

            return $this->redirectToRoute('recruiter_new_jobposting');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Il y a des erreurs dans le formulaire. Veuillez le corriger.');
        }

        return $this->render('recruiter_new_job_posting.html.twig', [
            'controller_name' => 'RecruiterNewJobPostingController',
            'form' => $form->createView(),
        ]);
    }
}