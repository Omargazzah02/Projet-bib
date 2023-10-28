<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $firstname = null;
  


    #[ORM\Column(length: 255)]
    public ?string $lastname = null;

 

    #[ORM\Column(length: 255)]

    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $isconnect = 0;

    #[ORM\Column]
    private ?int $isadmin = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getIsconnect(): ?int
    {
        return $this->isconnect;
    }

    public function setIsconnect(int $isconnect): static
    {
        $this->isconnect = $isconnect;

        return $this;
    }

    public function getIsadmin(): ?int
    {
        return $this->isadmin;
    }

    public function setIsadmin(int $isadmin): static
    {
        $this->isadmin = $isadmin;

        return $this;
    }

}
