<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Article
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $title = null;

    #[ORM\Column(length: 255)]
    public ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    public ?string $summary = null;

    #[ORM\Column(type: Types::TEXT)]
    public ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'articles')]
    public Collection $categories;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    public ?User $author = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addArticle($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeArticle($this);
        }

        return $this;
    }
}
