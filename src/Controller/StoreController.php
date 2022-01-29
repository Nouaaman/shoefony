<?php

namespace App\Controller;

use App\Repository\Store\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Store\Product;

class StoreController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/product_list', name: 'store_product_list', methods: ['GET'])]
    public function listProducts(): Response
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        return $this->render('store/product_list.html.twig', [
            'controller_name' => 'StoreController',
            'products' => $products,
        ]);
    }




    #[Route('/store/product/{id}/details/{slug}', name: 'store_product_detail', methods: ['GET'])]
    public function productDetail(int $id, string $slug): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('store/product_detail.html.twig', [
            'controller_name' => 'StoreController',
            'product' => $product,
            'slug' => $slug
        ]);
    }
}
