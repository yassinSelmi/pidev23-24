<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PHPUnit\TextUI\XmlConfiguration\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Entrer le contenu')]
    private ?string $contenu = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;


    #[ORM\Column(length: 255)]
    private ?string $categorie = null;
    
    #[ORM\Column(length: 255)]
    private $image;

    #[ORM\Column(length: 255)]
    private ?string $support = null;



    /**
     * @Vich\UploadableField(mapping="reclamation",fileNameProperty="image")
     * @var File
     */
    private $imageFile;
    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): static
    {
        $this->support = $support;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }
    /**
     * @param string|null $image
     * @return this
     */
    public function setImage(?string $image):self
    {
        $this->image=$image;
        return $this;
    }

        /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    /**
     * @param File|null $imageFile
     */
    public function setImageFile(?File $imageFile= null)
    {
        $this->imageFile=$imageFile;
        return $this;
    }
    






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNomSupport(): ?support
    {
        return $this->nomSupport;
    }

    public function setNomSupport(?support $nomSupport): static
    {
        $this->nomSupport = $nomSupport;

        return $this;
    }
}
