<?php

namespace App\Entity;

use App\Repository\RecommandationPersoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecommandationPersoRepository::class)]
class RecommandationPerso
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[ORM\Column(length: 5000)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'recommandationPerso')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\ManyToOne(targetEntity: RecommandationLevel::class, inversedBy: 'recommandationPerso')]
    #[ORM\JoinColumn(nullable: false, options: ['default' => 1])]
    private ?RecommandationLevel $level = null;

    #[ORM\ManyToOne(targetEntity: RecommandationStatus::class)]
    #[ORM\JoinColumn(nullable: false, options: ['default' => 4])]
    private ?RecommandationStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'recommandationPerso', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collectivite $Collectivite = null;

    public function __toString()
    {
        return $this->body;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getLevel(): ?RecommandationLevel
    {
        return $this->level;
    }

    public function setLevel(?RecommandationLevel $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getStatus(): ?RecommandationStatus
    {
        return $this->status;
    }

    public function setStatus(?RecommandationStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCollectivite(): ?Collectivite
    {
        return $this->Collectivite;
    }

    public function setCollectivite(?Collectivite $Collectivite): static
    {
        $this->Collectivite = $Collectivite;

        return $this;
    }
}
