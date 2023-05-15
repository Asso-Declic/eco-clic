<?php

namespace App\Entity;

use App\Repository\CollectiviteAnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectiviteAnswerRepository::class)]
// #[ORM\Table(name: 'utilisateurReponse')]
class CollectiviteAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::GUID)]
    private ?int $id = null;

    #[ORM\Column(name: 'IdQuestion', type: Types::GUID)]
    private ?string $question = null;

    // #[ORM\Column(name: 'IdReponse', type: Types::GUID)]
    #[ORM\ManyToOne(targetEntity: Answer::class)]
    #[ORM\JoinColumn(name: 'IdReponse', nullable: false)]
    private ?Answer $answer = null;

    // #[ORM\Column(name: 'CollectiviteId', type: Types::GUID)]
    #[ORM\ManyToOne(targetEntity: Collectivite::class, inversedBy: 'collectiviteAnswers')]
    #[ORM\JoinColumn(name: 'CollectiviteId', nullable: false)]
    private ?Collectivite $collectivite = null;

    #[ORM\Column(name: 'InputText', type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\Column(name: 'Date')]
    private ?\DateTimeImmutable $answeredAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(Answer $answer): self
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
}
