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
        $subtitle = "Forum pour les émos";

        return $this->render('front/index.html.twig', [
            'subtitle' => $subtitle,
        ]);
    }

    #[Route('/rules', name: 'rules')]
    public function rules(): Response
    {
        return $this->render('front/rules.html.twig', [          
        ]);
    }

    #[Route('/home/article/{!page<\d+>?1}', name: 'article') ]
    public function article(): Response
    {
        return $this->render('front/article.html.twig', [          
        ]);
    }

    #[Route('/home/article/add', name: 'add') ]
    public function add(): Response
    {
        return $this->render('front/add.html.twig', [          
        ]);
    }
}
