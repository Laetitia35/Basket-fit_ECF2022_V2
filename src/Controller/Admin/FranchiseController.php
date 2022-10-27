<?php

namespace App\Controller\Admin;

use App\Entity\Franchise;
use App\Form\FranchiseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FranchiseController extends AbstractController
{
    #[Route('/admin/creer_une_franchise', name: 'app_create_franchise')]
    public function createFranchise(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Instance de la classe franchise
        $franchise = new Franchise();
        //creation du formulaire
        $form = $this->createForm(FranchiseType::class, $franchise); 
        // ecouteur de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            /**
             *  //Permission $Permission
             */
            //$permissions = $form->get('permissions')->getData();
            
            //foreach ($permissions as $permission) {
                
                //$franchise->addPermission($permission);   
            //}

            $entityManager->persist($franchise);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/franchise/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/modifier_une_franchise/{id}', name: 'app_update_franchise')]
    public function UpdateFranchise(Franchise $franchise, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        //creation du formulaire
        $form = $this->createForm(FranchiseType::class, $franchise); 
        // ecouteur de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager->persist($franchise);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/franchise/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/admin/activer_une_franchise/{id}', name: 'app_enable_franchise')]
    public function EnableFranchise(Franchise $franchise, EntityManagerInterface $entityManager)
    {
        $franchise->setActif(($franchise->isActif())? false:true);

        $entityManager->persist($franchise);
        $entityManager->flush();

        return new Response("true");      
    } 
    
    #[Route('/admin/supprimer_une_franchise/{id}', name: 'app_delete_franchise')]
    public function DeleteFranchise(Franchise $franchise, EntityManagerInterface $entityManager)
    {

        $entityManager->persist($franchise);
        $entityManager->remove($franchise);

        $this->addFlash('message', 'Franchise supprimer avec succès');

        return $this->redirectToRoute('app_admin');  
        
    } 

}


