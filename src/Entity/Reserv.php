<?php

namespace App\Entity;

use App\Repository\ReservRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservRepository::class)]
class Reserv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $iduser = null;

    #[ORM\Column]
    private ?int $idevent = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $nb_persones = null;

    #[ORM\Column]
    private ?int $max_nb_persones = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function setIdevent(int $idevent): static
    {
        $this->idevent = $idevent;

        return $this;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
