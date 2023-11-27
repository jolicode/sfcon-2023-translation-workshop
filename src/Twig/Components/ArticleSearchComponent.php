<?php

namespace App\Twig\Components;

use App\Repository\ArticleRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ArticleSearchComponent
{
    use ComponentToolsTrait;
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(
        private readonly ArticleRepository $articleRepository
    ) {
    }

    #[LiveAction]
    public function getArticles(): array
    {
        $articles = $this->articleRepository->search($this->query);
        $this->emit('article:search', ['count' => count($articles)]);
        $this->dispatchBrowserEvent('article:search', ['count' => count($articles)]);

        return $articles;
    }
}
