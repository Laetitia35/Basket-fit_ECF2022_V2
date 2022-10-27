<?php

namespace App\Controller\Admin;

use App\Entity\Permission;
use App\Entity\Structure;
use App\Form\StructureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StructureController extends AbstractController
{
    #[Route('/admin/creer_une_structure', name: 'app_create_structure')]
    public function createStructure(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Instance de la classe Structure
        $structure = new Structure();

         //creation du formulaire
        $form = $this->createForm(StructureType::class, $structure); 

        // ecouteur de la requête
        $form->handleRequest($request);
         
        // condition si le formulaire et envoyer et valide alors j'execute le code
        if($form->isSubmitted() && $form->isValid()) {

        //on ajoute les permissions accordés à la franchise  

            /**
             * //Franchise $franchise
             */
            //$franchise = $form->get('Franchise')->getData();
            //$Permissions = $franchise->getPermissions();

            /*foreach ($Permissions as $Permission) {
                /**
                 * @var Permission $permissions
                 */
                //$permissionsFranchise = new Permission();
                //$permissionsFranchise->setPermission($Permissions->setPermission());
                //$permissionsFranchise->setActif($Permissions->setActif());
                //$permissionsFranchise->addStructure($form->getData());
                //$structure->addPermission($permissionsFranchise);
                
            //}

            $entityManager->persist($structure);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/structure/index.html.twig', [
            'form' => $form->createView(),
           ]);
    }
    
    #[Route('/admin/modifier_une_structure/{id}', name: 'app_update_structure')]
    public function UpdateStructure(Request $request, EntityManagerInterface $entityManager, Structure $structure): Response
    {

        $form = $this->createForm(StructureType::class, $structure); //creation du formulaire
        // ecouteur de la requête
        $form->handleRequest($request);
         
        // condition si le formulaire et envoyer et valide alors j'execute le code
        if($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->persist($structure);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin');
        }


        return $this->render('admin/structure/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/activer_une_structure/{id}', name: 'app_enable_structure')]
    public function EnableStructure( EntityManagerInterface $entityManager, Structure $structure)
    {

        $structure->setActif(($structure->isActif())? false:true);
       
        $entityManager->persist($structure);
        $entityManager->flush();

        return new Response ("true");   
        
    }

    #[Route('/admin/supprimer_une_structure/{id}', name: 'app_delete_structure')]
    public function DeleteStructure( EntityManagerInterface $entityManager, Structure $structure) 
    {

        $entityManager->persist($structure);
        $entityManager->remove($structure);

        $this->addFlash('message', 'Structure supprimer avec succès.');

        return $this->redirectToRoute('app_admin');
    }
} 
