<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(): Response
    {
        return $this->render('connexion/register.html.twig', [

        ]);
    }

   #[Route('/login', name: 'app_login')]
   public function login(): Response
   {
      return $this->render('connexion/login.html.twig', [

      ]);
   }
   #[Route('/logout', name: 'app_logout', methods: ['GET'])]
   public function logout()
   {

   }
}
