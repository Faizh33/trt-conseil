<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $candidate = new Candidate();

        $form = $this->createForm(CandidateType::class, $candidate, ['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cv = $form['cvName']->getData();
            if ($cv instanceof UploadedFile) {
                $fileName = md5(uniqid()) . '.' . $cv->guessExtension();
                $cv->move(
                    $this->getParameter('pdf_directory'),
                    $fileName
                );
                $candidate->setCvName($fileName);
            }
            
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
