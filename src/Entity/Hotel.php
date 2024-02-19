<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    #[Assert\NotBlank(message:'obligatoir')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'obligatoir')]

    
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'obligatoir')]
    private ?string $ville = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\Length(
        min: 1,
        max: 5,
        minMessage: 'Le nombre de etoile doit etre varie entre 1 et 5',
    )]
    private ?int $etoile = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'obligatoir')]
    private ?string $equipement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'obligatoir')]
    private ?string $disponibliter = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;
   

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEtoile(): ?int
    {
        return $this->etoile;
    }

    public function setEtoile(int $etoile): static
    {
        $this->etoile = $etoile;

        return $this;
    }

    public function getEquipement(): ?string
    {
        return $this->equipement;
    }

    public function setEquipement(string $equipement): static
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getDisponibliter(): ?string
    {
        return $this->disponibliter;
    }

    public function setDisponibliter(string $disponibliter): static
    {
        $this->disponibliter = $disponibliter;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
