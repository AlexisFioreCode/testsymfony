<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Service\SwearCleaner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 /**
  * @IsGranted("IS_AUTHENTICATED_FULLY")
  */

class FrontController extends AbstractController
{
    #[Route('/', name: 'index')]
    #[Route('/home', name: 'home')]

    public function index(): Response
    {

        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepository->findby(
            [],
            ["id" => "DESC"],
            3,
            0
        );

        return $this->render('front/index.html.twig', [
            'articles' => $articles,  
        ]);
    }
    #[Route('/home/article/{!id<\d+>?1}', name: 'article') ]
    public function article(int $id, SwearCleaner $swearCleaner): Response
    {   

        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $article = $articleRepository->find($id);
        $article = $swearCleaner->CleanSwear($article);
        return $this->render('front/article.html.twig', [ 
            'article' => $article,                
        ]);
    }

    #[Route('/home/article/add', name: 'addArticle') ]
    public function addArticle(Request $request): Response
    {
        // On crée un nouveau Subject vide et un formulaire sur la base de cette entité
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        // On traite les données soumises lors de la requêtes dans l'objet form
        $form->handleRequest($request);
        // Si on a soumis un formulaire et que tout est OK
        if($form->isSubmitted() && $form->isValid()) {
            $article->setCreatedDate(new \DateTime());
            // On enregistre le nouveau sujet
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            // Attention les requêtes ne sont exécutées que lors du flush donc à ne pas oublier
            $entityManager->flush();

            return $this->redirectToRoute('index');
            
        }
        
        return $this->render('front/addArticle.html.twig', [  
            "form" => $form->createView()      
        ]);
    }
}
