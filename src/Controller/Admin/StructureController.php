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
             * @var Franchise $franchise
             */
            $franchise = $form->get('Franchise')->getData();
            $Permissions = $franchise->getPermissions();

            foreach ($Permissions as $Permission) {
                /**
                 * @var Permission $permissions
                 */
                $permissionsFranchise = new Permission();
                //$permissionsFranchise->setPermission($Permissions->setPermission());
                $permissionsFranchise->setActif($Permissions->setActif());
                $permissionsFranchise->addStructure($form->getData());
                $structure->addPermission($permissionsFranchise);
                
            }

            $entityManager->persist($structure);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/structure/index.html.twig', [
            'form' => $form->createView(),
           ]);
    }   
} 
