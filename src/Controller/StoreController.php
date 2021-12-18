<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{


    #[Route('/product_list', name: 'store_product_list', methods: ['GET'])]
    public function list(): Response
    {
        return $this->render('store/product_list.html.twig', [
            'controller_name' => 'StoreController',
        ]);
    }

    #[Route('/product/detail/{id}', name: 'store_product_detail', methods: ['GET'])]
    public function details(int $id): Response
    {
        return $this->render('store/product_detail.html.twig', [
            'controller_name' => 'StoreController',
            'id' => $id
        ]);
    }
}
