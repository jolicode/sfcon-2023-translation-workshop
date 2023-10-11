<?php

namespace App\Factory;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use function Symfony\Component\String\u;

/**
 * @extends ModelFactory<Article>
 *
 * @method        Article|Proxy                     create(array|callable $attributes = [])
 * @method static Article|Proxy                     createOne(array $attributes = [])
 * @method static Article|Proxy                     find(object|array|mixed $criteria)
 * @method static Article|Proxy                     findOrCreate(array $attributes)
 * @method static Article|Proxy                     first(string $sortedField = 'id')
 * @method static Article|Proxy                     last(string $sortedField = 'id')
 * @method static Article|Proxy                     random(array $attributes = [])
 * @method static Article|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ArticleRepository|RepositoryProxy repository()
 * @method static Article[]|Proxy[]                 all()
 * @method static Article[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Article[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Article[]|Proxy[]                 findBy(array $attributes)
 * @method static Article[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Article[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ArticleFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     */
    public function __construct(
        private readonly SluggerInterface $slugger,
    ) {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function getDefaults(): array
    {
        return [
            'author' => UserFactory::random(),
            'content' => $content = self::faker()->text(),
            'createdAt' => \DateTimeImmutable::createFromMutable($createdAt = self::faker()->dateTime()),
            'title' => $title = self::faker()->text(25),
            'slug' => $this->slugger->slug($title)->lower(),
            'summary' => u($content)->slice(0, 150) . '...',
            'updatedAt' => \DateTimeImmutable::createFromMutable($createdAt->modify('+' . self::faker()->numberBetween(1, 5).' days')),
            'categories' => CategoryFactory::randomRange(1, 3),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Article::class;
    }
}
