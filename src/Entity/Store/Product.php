<?php

namespace App\Entity\Store;

use App\Entity\Store\Image;
use App\Entity\Store\Color;
use App\Entity\Store\Brand;
use App\Repository\Store\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: "sto_product")]


class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: "string")]
    private $descriptionLongue;


    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false, name: 'sto_image_id')]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;


    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: "products")]
    #[ORM\JoinColumn(nullable: false, name: 'sto_brand_id')]
    private $brand;

    #[ORM\ManyToMany(targetEntity: Color::class, mappedBy: "products")]
    #[ORM\JoinTable(name: "sto_color")]
    private $colors;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->colors = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionLongue(): ?string
    {
        return $this->descriptionLongue;
    }
    public function setDescriptionLongue(string $descriptionLongue): self
    {
        $this->descriptionLongue = $descriptionLongue;
        return $this;
    }


    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($slug);
        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColors()
    {
        return $this->colors;
    }

    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
            $color->addProduct($this);
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        if ($this->colors->removeElement($color)) {
            $color->removeProduct($this);
        }

        return $this;
    }
}
