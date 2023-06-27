<?php

namespace App\Entity;

use App\Repository\RecommandationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RecommandationRepository::class)]
class Recommandation
{
    #[Groups(['collectivite_status'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['collectivite_status'])]
    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'recommandations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\ManyToOne(targetEntity: RecommandationLevel::class, inversedBy: 'recommandations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecommandationLevel $level = null;

    #[ORM\ManyToOne(targetEntity: RecommandationStatus::class)]
    #[ORM\JoinColumn(nullable: false, options: ['default' => 4])]
    private ?RecommandationStatus $status = null;

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
}
