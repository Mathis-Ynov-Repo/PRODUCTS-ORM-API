<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\ArticleStatus;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $categories = [];

        for ($i = 0; $i < 20; $i++) {
            $category = new Category();

            $category->setName($faker->word());

            $manager->persist($category);
            $categories[] = $category;
        }

        for ($j = 0; $j < 70; $j++) {

            $product = new Product();
            $product->setName($faker->words(4, true))
            ->setDescription($faker->sentence(5, true))
            ->addCategory($categories[$faker->numberBetween(0, count($categories)-1)])
            ->addCategory($categories[$faker->numberBetween(0, count($categories)-1)])
            ->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100));
            

            $manager->persist($product);
        }

        $manager->flush();
    }
}
