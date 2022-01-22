<?php

namespace App\Mailer;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

final class ContactMailer
{
    private MailerInterface $mailer;
    private Environment $twig;
    private string $contactEmailAddress;

    public function __construct(MailerInterface $mailer, Environment $twig, string $contactEmailAddress)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->contactEmailAddress = $contactEmailAddress;
    }

    public function send(): void
    {

        $email = (new Email())
            ->from('hello@gmail.com')
            ->to('contact@shoefony.com')
            ->subject('Un message de contact sur Shoefony')
            ->html($this->twig->render('email/contact.html.twig', ['contact' => $this->contactEmailAddress]));
        $this->mailer->send($email);
    }
}
