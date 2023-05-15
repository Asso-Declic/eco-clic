<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
    private ?int $id = null;

    // #[ORM\Column(name: 'CollectiviteId', type: Types::GUID)]
    #[ORM\ManyToOne(targetEntity: Collectivite::class, inversedBy: 'scores')]
    #[ORM\JoinColumn(name: 'CollectiviteId', nullable: false)]
    private ?Collectivite $collectivite = null;
    
    #[ORM\Column(name: 'Score')]
    private ?int $score = null;

    #[ORM\Column(name: 'Date')]
    private ?\DateTimeImmutable $scoredAt = null;

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
}
