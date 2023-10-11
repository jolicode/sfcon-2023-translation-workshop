<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    #[Route('/', name: 'app_blog')]
    public function index(): Response
    {
        $articles = $this->articleRepository->findBy([], ['createdAt' => 'DESC'], 5);

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
