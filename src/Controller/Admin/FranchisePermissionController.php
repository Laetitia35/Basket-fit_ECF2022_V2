<?php

namespace App\Controller\Admin;

use App\Entity\FranchisePermission;
use App\Form\FranchisePermissionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FranchisePermissionController extends AbstractController
{
    #[Route('/admin/creer_une_franchise_permission', name: 'app_franchise_permission')]
    public function createFranchisePermission(Request $request, EntityManagerInterface $entityManager): Response
    {
         //Instance de la classe Permission
         $franchise_permission = new FranchisePermission;

        //creation de la permission
         $form = $this->createForm(FranchisePermissionType::class, $franchise_permission); 
         
         // ecouteur de la requête
         $form->handleRequest($request);
          
         // condition si le formulaire et envoyer et valide alors j'execute le code
         if($form->isSubmitted() && $form->isValid()) {
     
            
             $entityManager->persist($franchise_permission);
             $entityManager->flush();
 
             return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/franchise_permission/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
