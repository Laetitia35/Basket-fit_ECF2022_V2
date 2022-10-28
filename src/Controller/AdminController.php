<?php

namespace App\Controller;

use App\Entity\Franchise;
use App\Entity\Permission;
use App\Entity\Structure;
use App\Entity\User;
use App\Repository\FranchiseRepository;
use App\Repository\StructureRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{   
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(FranchiseRepository $repositoryFranchises, StructureRepository $repositoryStructure, UserRepository $repositoryUser ): Response
    {    
        /* @var Franchise $franchises */
        $franchises = $repositoryFranchises->findAll();
        $structures = $repositoryStructure->findAll();
        $user = $repositoryUser->findAll();
        //$permissions = $this->entityManager->getRepository(Franchise:: class);
        //$permissions = $franchise->getPermissions();
       
            //dump($franchises->getPermissions());
        
        
        return $this->render('admin/panel.html.twig',[
            'franchises' => $franchises,
            'structures' => $structures,
            'user' => $user,
            //'permissions' => $permissions
            
        ]);
    }
}
