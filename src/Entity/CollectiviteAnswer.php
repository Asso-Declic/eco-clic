<?php

namespace App\Entity;

use App\Repository\CollectiviteAnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CollectiviteAnswerRepository::class)]
class CollectiviteAnswer
{
    #[Groups(['collectiviteAnswer'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['collectiviteAnswer'])]
    #[ORM\ManyToOne(targetEntity: Answer::class, inversedBy: 'collectiviteAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Answer $answer = null;

    #[ORM\ManyToOne(targetEntity: Collectivite::class, inversedBy: 'collectiviteAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collectivite $collectivite = null;

    #[Groups(['collectiviteAnswer'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $answeredAt = null;

    #[ORM\ManyToOne(inversedBy: 'collectiviteAnswers')]
    private ?User $user = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): self
    {
        $this->answer = $answer;

        return $this;
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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAnsweredAt(): ?\DateTimeImmutable
    {
        return $this->answeredAt;
    }

    public function setAnsweredAt(\DateTimeImmutable $answeredAt): self
    {
        $this->answeredAt = $answeredAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
