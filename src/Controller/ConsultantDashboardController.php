<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultantDashboardController extends AbstractController
{
    #[Route('/consultant/tableau-de-bord', name: 'consultant_dashboard')]
    public function index(): Response
    {
        return $this->render('consultant_dashboard.html.twig', [
            'controller_name' => 'ConsultantDashboardController',
        ]);
    }
}
