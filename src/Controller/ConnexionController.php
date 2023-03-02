<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $manager): Response
    {
       $user = new User();
       $form = $this->createForm(RegisterFormType::class, $user);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()){
          $user->setPassword(
             $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
             )
          );
          $user->setCreatedAt(new \DateTimeImmutable())
               ->setUpdatedAt(new \DateTimeImmutable())
               ->setRoles(['ROLE_USER'])
               ->setIsDesactivated(false);
          $manager->persist($user);
          $manager->flush();

          return $this->redirectToRoute('app_login');
       }

        return $this->render('connexion/register.html.twig', [
            'register'=>$form->createView(),
        ]);
    }

   #[Route('/login', name: 'app_login')]
   public function login(AuthenticationUtils $authenticationUtils): Response
   {
      $error = $authenticationUtils->getLastAuthenticationError();
      $lastUsername = $authenticationUtils->getLastAuthenticationError();
      return $this->render('connexion/login.html.twig', [
         'last_username' => $lastUsername,
         'error' =>$error,
      ]);
   }

   #[Route('/logout', name: 'app_logout', methods: ['GET'])]
   public function logout()
   {

   }
}
