<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        #[Autowire('%app.supported_locales%')]
        private readonly array $supportedLocales,
        private readonly string $defaultLocale,
    ) {
    }

    #[Route('/')]
    public function indexNoLocale(Request $request): Response
    {
        $locale = $request->getPreferredLanguage($this->supportedLocales) ?? $this->defaultLocale;

        return $this->redirectToRoute('app_blog', ['_locale' => $locale]);
    }

    #[Route('/{_locale<%app.supported_locales_regex%>}/', name: 'app_blog')]
    public function index(): Response
    {
        $articles = $this->articleRepository->findBy([], ['createdAt' => 'DESC'], 5);

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
