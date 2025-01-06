<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/a-propos', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'page_class' => 'about-page',
            'menu_class' => 'about-menu',
        ]);
    }
    #[Route('/parcours', name: 'app_parcours')]
    public function parcours(): Response
    {
        return $this->render('home/parcours.html.twig', [
            'page_class' => 'parcours-page',
            'menu_class' => 'parcours-menu',
        ]);
    }
}
