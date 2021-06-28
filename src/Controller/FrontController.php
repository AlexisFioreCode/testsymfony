<?php

namespace App\Controller;

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

        return $this->render('front/index.html.twig', [
            'subtitle' => $subtitle,
        ]);
    }

    #[Route('/home/article/{!page<\d+>?1}', name: 'article') ]
    public function article(): Response
    {
        $subtitle = "Blog pour test symfony fait gaffe c'est de la merde";

        return $this->render('front/article.html.twig', [ 
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
