<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Mail\NewsletterSubscribedConfirmation;
use App\Repository\ArticleRepository;
use App\Repository\NewsletterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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
  public function newsletterSubscribe(
    Request $request,
    EntityManagerInterface $em,
    NewsletterSubscribedConfirmation $notificationService,
    HttpClientInterface $spamChecker
  ): Response {
    // 1 - J'initialise une instance de mon entité
    $newsletterEmail = new Newsletter();
    // 2 - Je crée un formulaire et y relie l'instance d'entité créée
    $form = $this->createForm(NewsletterType::class, $newsletterEmail);

    // 3 - Je prends en charge la requête entrante avec mon formulaire
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $response = $spamChecker->request(
        Request::METHOD_POST,
        "/api/check",
        [
          'json' => ['email' => $newsletterEmail->getEmail()]
        ]
      );

      try {
        $data = $response->toArray();
        $isSpam = $data['result'] === 'spam';

        if ($isSpam) {
          throw new \InvalidArgumentException();
        }
        $em->persist($newsletterEmail);
        $em->flush();
        $notificationService->send($newsletterEmail);
        // $this->addFlash("success", "Bravo ! Votre email a bien été enregistré !");
        return $this->redirectToRoute("newsletter_sub_confirm");
      } catch (ClientExceptionInterface | \InvalidArgumentException $ex) {
        $form->addError(new FormError("Une erreur est survenue lors de la vérification de l'email"));
      }
    }

    return $this->renderForm('newsletter/subscribe.html.twig', [
      'newsletterForm' => $form
    ]);
  }

  #[Route('/newsletter/subscribe/confirm', name: 'newsletter_sub_confirm')]
  public function newsletterSubscribeConfirm(ArticleRepository $articleRepository): Response
  {
    $articles = $articleRepository->findBy([], ['dateCreated' => 'DESC'], 10);
    return $this->render('newsletter/subscribe.confirm.html.twig', [
      'articles' => $articles
    ]);
  }
}
