<?php

namespace App\Mail;

use App\Entity\Newsletter;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class NewsletterSubscribedConfirmation
{
  public function __construct(
    private MailerInterface $mailer,
    private string $adminEmail
  ) {
  }

  public function send(
    Newsletter $newsletterEmail
  ) {
    // Envoi d'email
    $email = (new Email())
      ->from($this->adminEmail)
      ->to($newsletterEmail->getEmail())
      ->subject('Inscription à la newsletter')
      ->text('Merci, votre adresse ' . $newsletterEmail->getEmail() . ' a été enregistrée');

    $this->mailer->send($email);
  }
}
