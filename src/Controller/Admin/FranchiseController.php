<?php

namespace App\Controller\Admin;

use App\Entity\Franchise;
use App\Entity\User;
use App\Form\FranchiseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class FranchiseController extends AbstractController
{
    #[Route('/admin/creer_une_franchise', name: 'app_create_franchise')]
    public function createFranchise(Request $request,  EntityManagerInterface $entityManager, MailerInterface $mailer, SluggerInterface $slugger): Response
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
            
            // uploader une image 
            $logoFile = $form->get('logo')->getData();
            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logoFile->guessExtension();

                try {
                    $logoFile->move(
                        $this->getParameter('franchise_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $franchise->setLogo($newFilename);
            }


            $entityManager->persist($franchise);
            $entityManager->flush();
            $franchiseEmail = $franchise->getUser()->getEmail();
         
        // envoie un email     
            
            $email = (new Email ())
                ->from('admin@basket-fit.fr')
                ->to($franchiseEmail,'team-tech@basket-fit.fr')
                -> subject ('Votre franchise à été créer')
                -> text ("Votre franchise à bien été créer. Veuillez consulter vos permissions accordées à l'adresse suivante: https://basket-fit.herokuapp.com/. Vous trouverez vos identifiants et mot de passe transmis lors d'un précédent mail envoyer pour la création de votre profil utilisateur.");

            $mailer->send($email);

            $this->addFlash('success', 'Votre franchise à bien été inscrite.');

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/franchise/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/modifier_une_franchise/{id}', name: 'app_update_franchise')]
    public function UpdateFranchise(Franchise $franchise, Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, SluggerInterface $slugger): Response
    {
        
        //creation du formulaire
        $form = $this->createForm(FranchiseType::class, $franchise); 
        // ecouteur de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $logoFile = $form->get('Logo')->getData();
            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logoFile->guessExtension();

                try {
                    $logoFile->move(
                        $this->getParameter('franchise_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $franchise->setLogo($newFilename);
            }


            $entityManager->persist($franchise);
            $entityManager->flush();
        
            $franchiseEmail = $franchise->getUser()->getEmail();
         
        // envoie un email     
            
            $email = (new Email ())
                ->from('admin@basket-fit.fr')
                ->to($franchiseEmail,'team-tech@basket-fit.fr')
                -> subject ('Votre franchise à été modifier')
                -> text ("Votre franchise à bien été modifier. Veuillez consulter les modifications effectués à l'adresse suivante: https://basket-fit.herokuapp.com/.");

            $mailer->send($email);

            $this->addFlash('success', 'Votre franchise à bien été modifier.');

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

        $entityManager->remove($franchise);
        $entityManager->flush();

        $this->addFlash('message', 'Franchise supprimer avec succès');

        return $this->redirectToRoute('app_admin');  
        
    } 

}


