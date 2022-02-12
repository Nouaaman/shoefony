<?php

namespace App\DataFixtures;

use App\Entity\Store\Product;
use App\Entity\Store\Image;
use App\Entity\Store\Color;
use App\Entity\Store\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;




class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->loadBrands();
        $this->loadColors();
        $this->loadProducts();
        $manager->flush();
    }


    private const COLORS = [
        'Orange',
        'Marron',
        'Gris',
        'Blanc',
        'Noir',
        'Rouge',
        'Bleu',
        'Vert',
        'Jaune'
    ];

    private const BRANDS = [
        'Nike',
        'Puma',
        'Adidas',
        'Asics'
    ];

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    private function loadProducts(): void
    {
        for ($i = 1; $i < 15; $i++) {
            $product = new Product();
            $product->setName('Product ' . $i);
            $product->setDescription('Description ' . $i);
            $product->setBrand($this->getRandomEntityReference(Brand::class, self::BRANDS));
            $product->setDescriptionLongue('Une description tres longue de la chaussure lorem iunr uergnief iefnef uwfurwgr cidn pdsn ' . $i);
            $product->setPrice(mt_rand(30, 350));
            $product->setImage($this->createImage($i, $product->getName()));
            $product->setSlug($product->getName());

            for ($j = 0; $j < random_int(0, count(self::COLORS) -1); $j++) {
                if (random_int(0, 1)) {
                    /** @var Color $color */
                    $color = $this->getReference(Color::class . $j);
                    $product->addColor($color);
                }
            }

            $this->manager->persist($product);
        }
    }

    private function loadBrands(): void
    {
        foreach (self::BRANDS as $key => $name) {
            $brand = new Brand();
            $brand->setName($name);
            $this->manager->persist($brand);
            $this->addReference(Brand::class . $key, $brand);
        }
    }

    private function loadColors(): void
    {
        foreach (self::COLORS as $key => $name) {
            $color = new Color();
            $color->setName($name);
            $this->manager->persist($color);
            $this->addReference(Color::class . $key, $color);
        }
    }

    private function createImage(int $i, string $alt)
    {
        return (new Image())
            ->setUrl('shoe-' . $i . '.jpg')
            ->setAlt($alt);
    }


    /**
     * @param class-string $entityClass
     * 
     * @return object<class-string>
     */
    private function getRandomEntityReference(string $entityClass, array $data): object
    {
        return $this->getReference($entityClass . random_int(0, count($data) - 1));
    }

    private function loadComments(): void
    {
        foreach (self::BRANDS as $key => [$name]) {
            $brand = new Brand();
            $brand->setName($name);
            $this->manager->persist($brand);
            $this->addReference(Brand::class . $key, $brand);
        }
    }
}
