<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminNewsController extends AbstractController
{
    #[Route('/admin/news', name: 'app_admin_news')]
    public function show(NewsRepository $repository): Response
    {
       $news = $repository->findBy(
          [],
          ['id'=> 'ASC'],
       );

        return $this->render('admin/news/news.html.twig', [
            'news' => $news,
        ]);
    }

   #[Route('/admin/news/view/{id}', name: 'app_admin_view_news')]
   public function view(EntityManagerInterface $manager, News $news):Response
   {
      $news->setIsPublished(!$news->isIsPublished());
      $manager->flush();

      return $this->redirectToRoute('app_admin_news');
   }
}
