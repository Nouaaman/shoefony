<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    // #[Route('/store', name: 'store')]
    // public function index(): Response
    // {
    //     return $this->render('store/index.html.twig', [
    //         'controller_name' => 'StoreController',
    //     ]);
    // }



    #[Route('/products', name: 'main_products')]
    public function products(): Response
    {
        return $this->render('store/products.html.twig', []);
    }

    #[Route(
        '/store/product/{{id}}/details/{{slug}}',
        name: 'store_show_product',
        requirements: ['id' => '\d+']
    )]
    public function showProduct(int $id, string $slug): Response
    {
        return $this->render('store/product_details.html.twig', [
            'id' => $id,
            // 'from_routing' => $this->generateUrl('store_show_product', [
            //     'id' => $id,
            // ])
        ]);
    }
}
