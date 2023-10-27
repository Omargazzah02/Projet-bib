<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;
#[ORM\Column(type: 'text', nullable: true)]
private ?string $photo = null;

#[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $nb_persones = null;

    #[ORM\Column]
    private ?int $max_nb_persones = null;

 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

   

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getNbPersones(): ?int
    {
        return $this->nb_persones;
    }

    public function setNbPersones(int $nb_persones): static
    {
        $this->nb_persones = $nb_persones;

        return $this;
    }

    public function getMaxNbPersones(): ?int
    {
        return $this->max_nb_persones;
    }

    public function setMaxNbPersones(int $max_nb_persones): static
    {
        $this->max_nb_persones = $max_nb_persones;

        return $this;
    }

  
}
    

