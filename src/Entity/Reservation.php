<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThan('today')]
    private ?\DateTimeInterface $datedebut = null;

    #[Assert\Callback(callback: 'validateDates')]
    public function validateDates(ExecutionContextInterface $context)
    {
        // Vérifie si dateDebut est antérieure à dateFin
        if ($this->dateDebut >= $this->dateFin) {
            $context->buildViolation('La date de début doit être antérieure à la date de fin.')
                ->atPath('dateDebut')
                ->addViolation();
        }
    }
};

    #[ORM\Column]
    private ?int $nbrinvite = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column]
    private ?float $couttotale = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): static
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): static
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getNbrinvite(): ?int
    {
        return $this->nbrinvite;
    }

    public function setNbrinvite(int $nbrinvite): static
    {
        $this->nbrinvite = $nbrinvite;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCouttotale(): ?float
    {
        return $this->couttotale;
    }

    public function setCouttotale(float $couttotale): static
    {
        $this->couttotale = $couttotale;

        return $this;
    }
}
