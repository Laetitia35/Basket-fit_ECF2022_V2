<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/modifier-mot-de-passe', name: 'app_account_password')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $notification = null;
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, $user); 
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_pwd =$form->get('new_password')->getData();
            $password = $passwordHasher->hashPassword($user, $new_pwd);

            $user->setPassword($password);
            $this->entityManager->flush();
            $notification = "Votre mot de passe à bien été mis à jour.";
        }
        return $this->render('account_password/index.html.twig', [
            'form' =>$form->createView(),
            'notification' => $notification        
        ]);
    }
}
