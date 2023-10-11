<?php

namespace App\DataFixtures;

use App\Factory\ArticleFactory;
use App\Factory\CategoryFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'admin@symfony.com',
            'name' => 'Admin',
            'roles' => ['ROLE_ADMIN'],
        ]);
        CategoryFactory::createMany(5);
        ArticleFactory::createMany(15);
    }
}
