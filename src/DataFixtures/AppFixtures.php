<?php

namespace App\DataFixtures;

use App\Entity\Store\Product;
use App\Entity\Store\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;




class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->loadProducts();
        $manager->flush();
    }

    private function loadProducts(): void
    {
        for ($i = 1; $i < 15; $i++) {
            $product = new Product();
            $product->setName('Product ' . $i);
            $product->setDescription('Description ' . $i);
            $product->setDescriptionLongue('Une description tres longue de la chaussure lorem iunr uergnief iefnef uwfurwgr cidn pdsn ' . $i);
            $product->setPrice(mt_rand(10, 100));
            $product->setImage($this->createImage($i, $product->getName()));
            $product->setSlug($product->getName());
            $this->manager->persist($product);
        }
    }

    private function createImage(int $i, string $alt)
    {
        return (new Image())
            ->setUrl('shoe-' . $i . '.jpg')
            ->setAlt($alt);
    }
}
