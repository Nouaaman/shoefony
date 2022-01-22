<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\VarDumper\Cloner\Data;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ORM\Table(name: "app_conctact")]

class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    /**
     * @var string
     * 
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    #[ORM\Column(type: 'string', length: 50)]
    private string $firstName;
    /**
     * @var string
     * 
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    #[ORM\Column(type: 'string', length: 50)]
    private string $lastName;
    /**
     * @var string
     **/
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide.")]
    #[Assert\Email(message: "L'email {{ value }} n'est pas valide")]

    #[ORM\Column(type: 'string', length: 50)]
    private string $email;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide.")]
    #[Assert\Length(min: "25", minMessage: "Votre message doit contenir au minimum {{ limit }} caractères.")]

    #[ORM\Column(type: 'string', length: 255)]
    private string $message;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    /*set */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /*get */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
