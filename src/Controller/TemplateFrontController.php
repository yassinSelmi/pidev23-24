<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RestaurantRepository;


class TemplateFrontController extends AbstractController
{



    #[Route('/template/front/restaurants', name: 'app_template_front_restaurants')]
    public function index(RestaurantRepository $restaurantRepository): Response
    {
        return $this->render('template_front/restaurants.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
        ]);
    }
}
