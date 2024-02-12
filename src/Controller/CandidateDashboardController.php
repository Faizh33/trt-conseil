<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidateDashboardController extends AbstractController
{
    #[Route('/candidat/tableau-de-bord', name: 'candidate_dashboard')]
    public function index(): Response
    {
        return $this->render('candidate_dashboard.html.twig', [
            'controller_name' => 'CandidateDashboardController',
        ]);
    }
}