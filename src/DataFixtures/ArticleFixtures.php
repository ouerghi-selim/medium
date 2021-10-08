<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Tag;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbArticle = 1; $nbArticle <= 30; $nbArticle++){

            $article= new Article();
            $tag = new Tag();
            $article -> setName($faker->word());
            $article -> setContent($faker->paragraph);
            $article -> setCreatedAt(new \DateTime('today'));
            $article -> setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
            $article -> setReference($faker->randomLetter);
            $article -> setDraft(false);
            $tag -> setTitle($article->getName());
            $tag -> setCreatedAt(new \DateTime('today'));
            $manager->persist($tag);
            $article -> addTag($tag);
            $manager->persist($article);


        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
