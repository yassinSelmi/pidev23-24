<?php

namespace App\Entity;

use App\Repository\ReservationRestoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRestoRepository::class)]
class ReservationResto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?int $idClient = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nomClient = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?int $numeroClient = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?int $nbrPersonnes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateReserv = null;

   

    #[ORM\ManyToOne]
    private ?Restaurant $nomRestaurant = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReserv(): ?int
    {
        return $this->idReserv;
    }

    public function setIdReserv(int $idReserv): static
    {
        $this->idReserv = $idReserv;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(int $idClient): static
    {
        $this->idClient = $idClient;

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

    public function getNumeroClient(): ?int
    {
        return $this->numeroClient;
    }

    public function setNumeroClient(int $numeroClient): static
    {
        $this->numeroClient = $numeroClient;

        return $this;
    }

    public function getNbrPersonnes(): ?int
    {
        return $this->nbrPersonnes;
    }

    public function setNbrPersonnes(int $nbrPersonnes): static
    {
        $this->nbrPersonnes = $nbrPersonnes;

        return $this;
    }

    public function getDateReserv(): ?\DateTimeInterface
    {
        return $this->dateReserv;
    }

    public function setDateReserv(\DateTimeInterface $dateReserv): static
    {
        $this->dateReserv = $dateReserv;

        return $this;
    }



    public function getNomRestaurant(): ?Restaurant
    {
        return $this->nomRestaurant;
    }

    public function setNomRestaurant(?Restaurant $nomRestaurant): static
    {
        $this->nomRestaurant = $nomRestaurant;

        return $this;
    }
}