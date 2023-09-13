<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
  private const NB_ARTICLES = 120;
  public function load(ObjectManager $manager): void
  {
    for ($i = 1; $i <= self::NB_ARTICLES; $i++) {
      $article = new Article();
      $article
        ->setTitle("Sandwich Ukraine 🇺🇦 " . $i)
        ->setContent("library family mind whatever come many mission jungle home from middle airplane")
        ->setDateCreated(new \DateTime())
        ->setVisible(true);

      $manager->persist($article);
    }

    $manager->flush();
  }
}
