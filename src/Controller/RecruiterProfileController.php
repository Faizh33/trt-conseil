<?php

namespace App\Controller;

use App\Entity\Recruiter;
use App\Form\RecruiterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecruiterProfileController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/recruteur/mon-profil', name: 'recruiter_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(RecruiterType::class, null, ['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logo = $form['logoName']->getData();
            if ($logo instanceof UploadedFile) {
                $fileName = md5(uniqid()) . '.' . $logo->guessExtension();
                $logo->move(
                    $this->getParameter('pictures_directory'),
                    $fileName
                );
                $recruiter = new Recruiter();
                $recruiter->setLogoName($fileName);
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', "Votre profil a été mis à jour avec succès.");

            return $this->redirectToRoute('login');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Il y a des erreurs dans le formulaire. Veuillez le corriger.');
        }
        return $this->render('recruiter_profile.html.twig', [
            'controller_name' => 'RecruiterProfileController',
            'form' => $form->createView(),
        ]);
    }
}
