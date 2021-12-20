<?php

namespace App\Mailer;

use App\Entity\Contact;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class ContactMailer
{
    private MailerInterface $mailer;
    public function __construct(MailerInterface $mailer, Environment $twig, string $contactEmailAddress)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->contactEmailAddress = $contactEmailAddress;
        // dd($contactEmailAddress);
    }

    public function send(Contact $contact): void
    {
        $email = (new Email())
            ->from($contact->getEmail())
            ->to($this->contactEmailAddress)
            ->subject('uen bouvelle demande contact')
            ->html($this->twig->render('email/contact.html.twig', ['contact' => $contact]));


        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface) {
            //throw $th;
        }
    }
}
