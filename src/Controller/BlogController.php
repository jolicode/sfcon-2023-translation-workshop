<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Timezones;
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

    #[Route('/{_locale<%app.supported_locales_regex%>}/world', name: 'app_world')]
    public function world(Request $request): Response
    {
        return $this->render('blog/world.html.twig', [
            'countriesForm' => $this->createForm(CountryType::class),
            'currenciesForm' => $this->createForm(CurrencyType::class),
            'countryName' => $request->get('countryName'),
            'countryTimezones' => $request->get('countryTimezones'),
            'countryCurrencies' => $request->get('countryCurrencies'),
            'countryFlag' => $request->get('countryFlag'),
        ]);
    }
    #[Route('/{_locale<%app.supported_locales_regex%>}/world_post', name: 'app_world_post')]
    public function worldPost(Request $request): Response
    {
        if ($request->getMethod() !== 'POST') {
            throw new \LogicException('This route should only be called with POST method');
        }

        $form = $this->createForm(CountryType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $country = $form->getData();
            $countryName = Countries::getName($country);
            try {
                $countryCurrencies = array_map(
                    fn (string $currency) => Currencies::getName($currency),
                    Currencies::forNumericCode(Countries::getNumericCode($country))
                );
            } catch (\Exception) {
                $countryCurrencies = [];
            }
            $countryTimezones = Timezones::forCountryCode($country);
            $countryFlag = "https://flagsapi.com/$country/flat/64.png";

            return $this->redirectToRoute('app_world', [
                '_locale' => $request->getLocale(),
                'countryName' => $countryName,
                'countryTimezones' => $countryTimezones,
                'countryCurrencies' => $countryCurrencies,
                'countryFlag' => $countryFlag,
            ]);
        }

        return $this->redirectToRoute('app_world', [
            '_locale' => $request->getLocale(),
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

    #[Route('/{_locale<%app.supported_locales_regex%>}/author/{id}', name: 'app_author')]
    public function author(User $author): Response
    {
        return $this->render('blog/author.html.twig', [
            'author' => $author,
        ]);
    }

    #[Route('/{_locale<%app.supported_locales_regex%>}/search', name: 'app_search')]
    public function search(): Response
    {
        return $this->render('blog/search.html.twig');
    }
}
