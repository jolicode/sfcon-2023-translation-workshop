<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private readonly CategoryRepository $categoryRepository,
        private readonly UserRepository $userRepository,
        private readonly string $defaultLocale,
    ) {
    }

    #[Route('/')]
    public function indexNoLocale(Request $request): Response
    {
        $locale = $request->getPreferredLanguage() ?? $this->defaultLocale;

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

    #[Route('/{_locale<%app.supported_locales_regex%>}/article/{id}', name: 'app_article')]
    public function article(Article $article): Response
    {
        return $this->render('blog/article.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{_locale<%app.supported_locales_regex%>}/category/{id}', name: 'app_category')]
    public function category(Category $category): Response
    {
        return $this->render('blog/category.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{_locale<%app.supported_locales_regex%>}/categories', name: 'app_categories')]
    public function categories(): Response
    {
        return $this->render('blog/categories.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }

    #[Route('/{_locale<%app.supported_locales_regex%>}/authors', name: 'app_authors')]
    public function authors(): Response
    {
        return $this->render('blog/authors.html.twig', [
            'authors' => $this->userRepository->findAll(),
        ]);
    }

    #[Route('/{_locale<%app.supported_locales_regex%>}/search', name: 'app_search')]
    public function search(): Response
    {
        return $this->render('blog/categories.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }
}
