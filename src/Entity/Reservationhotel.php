<?php

namespace App\Entity;

use App\Repository\ReservationhotelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationhotelRepository::class)]
class Reservationhotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomhotel = null;

    #[ORM\Column(length: 255)]
    private ?string $nomClient = null;

    #[ORM\Column]
    private ?int $NbPersonne = null;

    #[ORM\Column]
    private ?int $NbNuit = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateArrive = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateSortie = null;

    #[ORM\Column]
    private ?float $prix = null;

  


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomhotel(): ?string
    {
        return $this->nomhotel;
    }

    public function setNomhotel(string $nomhotel): static
    {
        $this->nomhotel = $nomhotel;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): static
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getNbPersonne(): ?int
    {
        return $this->NbPersonne;
    }

    public function setNbPersonne(int $NbPersonne): static
    {
        $this->NbPersonne = $NbPersonne;

        return $this;
    }

    public function getNbNuit(): ?int
    {
        return $this->NbNuit;
    }

    public function setNbNuit(int $NbNuit): static
    {
        $this->NbNuit = $NbNuit;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->DateArrive;
    }

    public function setDateArrive(\DateTimeInterface $DateArrive): static
    {
        $this->DateArrive = $DateArrive;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->DateSortie;
    }

    public function setDateSortie(\DateTimeInterface $DateSortie): static
    {
        $this->DateSortie = $DateSortie;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
}
