<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateBackController extends AbstractController
{
    #[Route('/template/back', name: 'app_template_back')]
    public function index(): Response //affichage template
    {
        return $this->render('template_back/index.html.twig', [
            'controller_name' => 'TemplateBackController',
        ]);
    }
}
