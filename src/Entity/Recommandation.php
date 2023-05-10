<?php

namespace App\Entity;

use App\Repository\RecommandationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecommandationRepository::class)]
// #[ORM\Table(name: 'recommandation')]
class Recommandation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::GUID)]
    private ?int $id = null;

    #[ORM\Column(name: 'Titre', length: 5000, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(name: 'Text', type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\Column(name: 'IdQuestion', type: Types::GUID)]
    private ?string $question = null;

    #[ORM\Column(name: 'IdCategorie', type: Types::GUID)]
    private ?string $category = null;

    #[ORM\Column(name: 'NiveauReco', type: Types::SMALLINT)]
    private ?int $level = null;

    public function getId(): ?int
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

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
