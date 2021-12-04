<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_homepage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('main/homepage.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/presentation', name: 'main_presentation', methods: ['GET'])]
    public function presentation(): Response
    {
        return $this->render('main/presentation.html.twig', [
            'controller_name' => 'MainController',
            'pathinfo' => '/presentation'
        ]);
    }

    #[Route('/contact', name: 'main_contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig', [
            'controller_name' => 'StoreController',
            'pathinfo' => '/contact',
        ]);
    }
}
