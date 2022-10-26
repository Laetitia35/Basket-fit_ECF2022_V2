<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path:'/login_link', name: 'app_login_link')] 
    public function login_link (UserRepository $userRepository, LoginLinkHandlerInterface $loginLinkHandler, MailerInterface $mailer): Response
    {
        $users = $userRepository->findAll();

        foreach ($users as $user) {
            $loginLinkDetails = $loginLinkHandler->createLoginLink($user);
            $email = (new Email ())
                ->from('team-tech@basket-fit.fr')
                ->to($user->getEmail())
                ->subject ('Lien de connexion à votre espace Basket-fit')
                ->text ('Voici votre lien de connexion pour accéder à votre vos permissions accordés dans votre espace Basket-fit :' .$loginLinkDetails ->getUrl());
                
            $mailer->send($email);
        }

        return $this->redirectToRoute('app_account_password');
    }
}
