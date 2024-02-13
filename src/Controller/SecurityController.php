<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $role = $this->getUser()->getRoles()[0];
            switch ($role) {
                case 'ROLE_ADMIN':
                    return $this->redirectToRoute('admin_dashboard');
                case 'ROLE_CONSULTANT':
                    return $this->redirectToRoute('consultant_dashboard');
                case 'ROLE_RECRUITER':
                    return $this->redirectToRoute('recruiter_dashboard');
                case 'ROLE_CANDIDATE':
                    return $this->redirectToRoute('candidate_dashboard');
                default:
                    return $this->redirectToRoute('login');
            }
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'logout', methods: ['GET'])]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}