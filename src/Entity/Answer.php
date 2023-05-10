<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
#[ORM\Table(name: 'reponse')]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Id', type: Types::GUID)]
    private ?int $id = null;

    #[ORM\Column(name: 'Type', length: 50, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(name: 'Text', type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\Column(name: 'IdQuestion', type: Types::GUID)]
    private ?string $question = null;

    #[ORM\Column(name: 'Ponderation')]
    private ?int $ponderation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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

    public function getPonderation(): ?int
    {
        return $this->ponderation;
    }

    public function setPonderation(int $ponderation): self
    {
        $this->ponderation = $ponderation;

        return $this;
    }
}
