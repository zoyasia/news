<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
  #[Route('/', name: 'app_index')]
  public function index(ArticleRepository $articleRepository): Response
  {
    $articles = $articleRepository->findAll();

    return $this->render('index/index.html.twig', [
      'articles' => $articles,
    ]);
  }

  #[Route('/coucou', name: 'coucou_damien')]
  public function test(): Response
  {
    return new Response('Coucou Damien');
  }

  #[Route('/newsletter/subscribe', name: 'newsletter_subscribe')]
  public function newsletterSubscribe(Request $request): Response
  {
    // 1 - J'initialise une instance de mon entité
    $newsletterEmail = new Newsletter();
    // 2 - Je crée un formulaire et y relie l'instance d'entité créée
    $form = $this->createForm(NewsletterType::class, $newsletterEmail);

    // 3 - Je prends en charge la requête entrante avec mon formulaire
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // Persistance des données
    }

    return $this->renderForm('newsletter/subscribe.html.twig', [
      'newsletterForm' => $form
    ]);
  }
}
