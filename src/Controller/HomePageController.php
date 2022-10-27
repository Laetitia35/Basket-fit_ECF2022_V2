<?php

namespace App\Controller;

use App\Entity\Franchise;
use App\Entity\Structure;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/accueil', name: 'app_home_page')]
    public function home(): Response
    {
        $franchises = $this->entityManager->getRepository(Franchise::class)->findAll();
        $structures = $this->entityManager->getRepository(Structure:: class)->findAll();
       
        return $this->render('home_page/index.html.twig', [
            'franchises' => $franchises,
            'structures' => $structures
        ]);
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->redirectToroute('app_home_page');
    }
}
