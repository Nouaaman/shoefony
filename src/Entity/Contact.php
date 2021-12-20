<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    #[Assert\NotBlank(message: 'Ce champ ne peut pas etre vide')]
    private ?string $firstName = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas etre vide')]
    private ?string $lastName = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas etre vide')]
    #[Assert\NotBlank(message: "L'email {{value}} n'est pas valide")]
    private ?string $email = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut pas etre vide')]
    #[Assert\Length(min: "25", minMessage: 'Doit contenit au minimum {{ limit }}')]
    private ?string $message = null;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    public function setMessage($message): void
    {
        $this->message = $message;
    }
}
