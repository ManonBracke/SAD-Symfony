<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function show(NewsRepository $newsRepository): Response
    {
       $news = $newsRepository->findBy(
          ['IsPublished' => true],
          ['id' => 'ASC']
       );

        return $this->render('news/news.html.twig', [
            'news' => $news,
        ]);
    }

   #[Route('/news/{slug}', name: 'app_detail')]
   public function detail(News $news): Response
   {

      return $this->render('news/newsdetail.html.twig', [
         'news' => $news,
      ]);
   }

}
