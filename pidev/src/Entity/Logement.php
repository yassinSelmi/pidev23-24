<?php

namespace App\Entity;

use App\Repository\LogementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogementRepository::class)]
class Logement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $emplacement = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column]
    private ?int $nbrchambre = null;

    #[ORM\Column]
    private ?int $nbrsdb = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $comodite = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): static
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getNbrchambre(): ?int
    {
        return $this->nbrchambre;
    }

    public function setNbrchambre(int $nbrchambre): static
    {
        $this->nbrchambre = $nbrchambre;

        return $this;
    }

    public function getNbrsdb(): ?int
    {
        return $this->nbrsdb;
    }

    public function setNbrsdb(int $nbrsdb): static
    {
        $this->nbrsdb = $nbrsdb;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getComodite(): ?string
    {
        return $this->comodite;
    }

    public function setComodite(string $comodite): static
    {
        $this->comodite = $comodite;

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
}
