<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/accueil', name: 'app_home_page')]
    public function home(): Response
    {
        return $this->render('home_page/index.html.twig');
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->redirectToroute('app_home_page');
    }
}
