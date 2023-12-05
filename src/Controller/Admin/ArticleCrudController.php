<?php

namespace App\Controller\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Article;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title')->onlyOnIndex(),
            TextEditorField::new('content')->setFormType(TranslationsType::class)->setFormTypeOptions([
                'fields' => [
                    'content' => [
                        'field_type' => TextEditorType::class,
                    ],
                ]
            ]),
            DateField::new('createdAt'),
            DateField::new('updatedAt'),
            AssociationField::new('author')
                ->formatValue(fn ($value, Article $entity) => $entity->author->name),
            AssociationField::new('categories')
                ->formatValue(fn ($value, Article $entity) => rtrim(array_reduce($entity->categories->toArray(), fn ($_, Category $c) => $_ . $c->name . ', ', ''), ', '))
            ,
        ];
    }
}
