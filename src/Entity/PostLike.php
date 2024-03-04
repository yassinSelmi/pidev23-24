<?php

namespace App\Entity;
use App\Entity\Hotel;
use App\Repository\PostLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostLikeRepository::class)]
class PostLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?Hotel $post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Hotel
    {
        return $this->post;
    }

    public function setPost(?Hotel $post): static
    {
        $this->post = $post;

        return $this;
    }
}
