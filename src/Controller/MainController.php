<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Mailer\ContactMailer;
use App\Repository\Store\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    private ContactMailer $mailer;
    private $em;

    public function __construct(EntityManagerInterface $em, ContactMailer $mailer,ProductRepository $proRepo)
    {
        $this->mailer = $mailer;
        $this->em = $em;
    }


    #[Route('/', name: 'main_homepage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/presentation', name: 'main_presentation', methods: ['GET'])]
    public function presentation(): Response
    {
        return $this->render('main/presentation.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('/contact', name: 'main_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contact);
            $this->em->flush();
            $this->addFlash('success', 'Merci, votre message a été pris en compte !');
            try {
                $this->mailer->send($contact);
            } catch (TransportExceptionInterface) {
            }

            return $this->redirectToRoute('main_contact');
        }
        return $this->render('main/contact.html.twig', [
            'form' => $form->createView()
            //'controller_name' => 'MainController',
        ]);
    }
}
