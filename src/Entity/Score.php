<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    #[Groups(['score'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
    private ?int $id = null;

    #[Groups(['score'])]
    #[ORM\ManyToOne(targetEntity: Collectivite::class, inversedBy: 'scores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collectivite $collectivite = null;
    
    #[Groups(['score', 'stats'])]
    #[ORM\Column]
    private ?int $score = null;

    #[Groups(['score', 'stats'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $scoredAt = null;

    // Si la catégorie est null, le score est le score global de la collectivité
    #[Groups(['score', 'stats'])]
    #[ORM\ManyToOne(targetEntity: Category::class)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollectivite(): ?Collectivite
    {
        return $this->collectivite;
    }

    public function setCollectivite(?Collectivite $collectivite): self
    {
        $this->collectivite = $collectivite;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getScoredAt(): ?\DateTimeImmutable
    {
        return $this->scoredAt;
    }

    public function setScoredAt(\DateTimeImmutable $scoredAt): self
    {
        $this->scoredAt = $scoredAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
