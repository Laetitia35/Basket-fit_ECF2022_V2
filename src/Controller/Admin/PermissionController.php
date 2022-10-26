<?php

namespace App\Controller\Admin;

use App\Entity\Permission;
use App\Form\PermissionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionController extends AbstractController
{
    #[Route('/admin/creer_une_permission', name: 'app_create_permission')]
    public function createPermission(Request $request, EntityManagerInterface $entityManager): Response
    {
         //Instance de la classe Permission
         $permission = new Permission;

        //creation de la permission
         $form = $this->createForm(PermissionType::class, $permission); 
         
         // ecouteur de la requête
         $form->handleRequest($request);
          
         // condition si le formulaire et envoyer et valide alors j'execute le code
         if($form->isSubmitted() && $form->isValid()) {
     
            
             $entityManager->persist($permission);
             $entityManager->flush();
 
             return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/permission/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
