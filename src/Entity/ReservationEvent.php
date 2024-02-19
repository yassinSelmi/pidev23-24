<?php

namespace App\Entity;

use App\Repository\ReservationEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationEventRepository::class)]
class ReservationEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $nbrpersonnes = null;

    #[ORM\Column]
    private ?bool $vip = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNbrpersonnes(): ?int
    {
        return $this->nbrpersonnes;
    }

    public function setNbrpersonnes(int $nbrpersonnes): static
    {
        $this->nbrpersonnes = $nbrpersonnes;

        return $this;
    }

    public function isVip(): ?bool
    {
        return $this->vip;
    }

    public function setVip(bool $vip): static
    {
        $this->vip = $vip;

        return $this;
    }
}
