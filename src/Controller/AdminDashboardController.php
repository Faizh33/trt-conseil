<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin/tableau-de-bord', name: 'admin_dashboard')]
    public function index(): Response
    {
        return $this->render('admin_dashboard.html.twig', [
            'controller_name' => 'AdminDashboardController',
        ]);
    }
}
