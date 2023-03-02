<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUsersController extends AbstractController
{
    #[Route('/admin/users', name: 'app_admin_user')]
    public function index(UserRepository $repository): Response
    {
        $users =  $repository->findBy(
           [],
           ['username'=>'DESC']
        );
        return $this->render('admin/base.html.twig', [
            'users'=>$users,
        ]);
    }

   #[Route('/admin/users/view/{id}', name: 'app_admin_view_user')]
   public function view(EntityManagerInterface $manager, User $users):Response
   {
      $users->setIsDesactivated(!$users->isIsDesactivated());
      $manager->flush();

      return $this->redirectToRoute('app_admin_users');
   }


   /**
    * @param User $user
    * @param EntityManagerInterface $manager
    * @param $role
    * @return Response
    */
   #[Route('/admin/promote/{id}/{role}', name: 'app_admin_users_promote')]
   #[IsGranted('ROLE_SUPER_ADMIN')]
   public function promote(User $user, EntityManagerInterface $manager, $role): Response
   {
      $user->setRoles([$role]);
      $manager->flush();
      $this->addFlash('success','L\'utilisateur a bien été promu.');
      return $this->redirectToRoute('app_admin_users');
   }


}
