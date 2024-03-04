<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;//controle saisie biblio
use Symfony\Component\Serializer\Annotation\Groups ;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['restaurants'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['restaurants'])]
    private ?string $nomResto = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['restaurants'])]
    private ?string $adresseResto = null;

    #[ORM\Column(length: 255)]
    #[Assert\Positive]
    #[Assert\Length(
        min: 8,
        max: 8,
        minMessage: 'Le numéro doit etre composé par 8 chiffre',
    )]  
    #[Groups(['restaurants'])]  
    private ?string $numeroResto = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['restaurants'])]
    private ?string $specialtie = null;


    #[ORM\Column(length: 255)]
    #[Groups(['restaurants'])]
    private ?string $image = null;


    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }




    
    #[ORM\Column]
    #[Assert\NotBlank(message:'le champ est obligatoire')]
    #[Assert\Length(
        min: 1,
        max: 3,
        minMessage: 'Le nombre de fourchette doit etre varie entre 1 et 3',
    )]
    #[Groups(['restaurants'])] 
    private ?int $nombreFourchette = null;
    public function getnombreFourchette(): ?int
    {
        return $this->nombreFourchette;
    }
    public function setnombreFourchette(int $nombreFourchette): static
    {
        $this->nombreFourchette = $nombreFourchette;
        return $this;
    }



    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['restaurants'])]
    private ?int $FourchetteDePrix = null;

    public function getFourchetteDePrix(): ?int
    {
        return $this->FourchetteDePrix;
    }
    public function setFourchetteDePrix(int $FourchetteDePrix): static
    {
        $this->FourchetteDePrix = $FourchetteDePrix;
        return $this;
    }





    #[ORM\Column]
    #[Groups(['restaurants'])]
    private ?int $heureOuverture = null;

    public function getHeureOuverture(): ?int
    {
        return $this->heureOuverture;
    }
    public function setHeureOuverture(int $heureOuverture): static
    {
        $this->heureOuverture = $heureOuverture;
        return $this;
    }



    #[ORM\Column]
    #[Groups(['restaurants'])]
    private ?int $heureFermeture = null;
    
    public function getheureFermeture(): ?int
    {
        return $this->heureFermeture;
    }
    public function setheureFermeture(int $heureFermeture): static
    {
        $this->heureFermeture = $heureFermeture;
        return $this;
    }










    public function __toString()
    {
        return $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomResto(): ?string
    {
        return $this->nomResto;
    }

    public function setNomResto(string $nomResto): static
    {
        $this->nomResto = $nomResto;

        return $this;
    }

    public function getAdresseResto(): ?string
    {
        return $this->adresseResto;
    }

    public function setAdresseResto(string $adresseResto): static
    {
        $this->adresseResto = $adresseResto;

        return $this;
    }

    public function getNumeroResto(): ?string
    {
        return $this->numeroResto;
    }

    public function setNumeroResto(string $numeroResto): static
    {
        $this->numeroResto = $numeroResto;

        return $this;
    }

    public function getspecialtie(): ?string
    {
        return $this->specialtie;
    }

    public function setspecialtie(string $specialtie): static
    {
        $this->specialtie = $specialtie;

        return $this;
    }
}