<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruiterDashboardController extends AbstractController
{
    #[Route('/recruteur/tableau-de-bord', name: 'recruiter_dashboard')]
    public function index(): Response
    {
        return $this->render('recruiter_dashboard.html.twig', [
            'controller_name' => 'RecruiterDashboardController',
        ]);
    }
}
