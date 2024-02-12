<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/creer-un-compte', name: 'account')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si l'email existe déjà en base de données
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                // Ajouter un message d'erreur
                $this->addFlash('error', 'Cet email existe déjà en base de données.');
            } else {
                // Si l'email n'existe pas, continuer avec la persistance de l'utilisateur
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
    
                $selectedRole = $form->get('roles')->getData();
                if ($selectedRole === 'ROLE_CANDIDATE') {
                    $user->setRoles(['ROLE_CANDIDATE']);
                } elseif ($selectedRole === 'ROLE_RECRUITER') {
                    $user->setRoles(['ROLE_RECRUITER']);
                } 

                $this->entityManager->persist($user);
                $this->entityManager->flush();
                
                $this->addFlash('success', 'Votre compte a été créé avec succès.');
                return $this->redirectToRoute('login');
            }
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Il y a des erreurs dans le formulaire. Veuillez le corriger.');
        }

        return $this->render('account.html.twig', [
            'controller_name' => 'AccountController',
            'form' => $form->createView(),
        ]);
    }
}
