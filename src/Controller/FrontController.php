<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'index')]
    #[Route('/home', name: 'home')]

    public function index(): Response
    {
        $subtitle = "Blog pour test symfony fait gaffe c'est de la merde";

        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepository->findby(
            [],
            ["id" => "DESC"],
            3,
            0
        );
        dump($articles);
        return $this->render('front/index.html.twig', [
            'subtitle' => $subtitle,
            'articles' => $articles,  
        ]);
    }

    #[Route('/home/article/{!id<\d+>?1}', name: 'article') ]
    public function article(int $id): Response
    {   
        $subtitle = "Blog pour test symfony fait gaffe c'est de la merde";

        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $article = $articleRepository->find($id);

        return $this->render('front/article.html.twig', [ 
            'article' => $article,
            'subtitle' => $subtitle,                  
        ]);
    }

    #[Route('/home/article/add', name: 'add') ]
    public function add(): Response
    {
        $subtitle = "Blog pour test symfony fait gaffe c'est de la merde";

        return $this->render('front/add.html.twig', [
            'subtitle' => $subtitle,          
        ]);
    }
}
