<?php

namespace App\Entity;

use App\Repository\RecommandationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RecommandationRepository::class)]
class Recommandation
{
    #[Groups(['collectivite_status', 'recommandation_perso'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['collectivite_status', 'recommandation_perso'])]
    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $title = null;

    #[Groups(['recommandation_perso'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[Groups(['recommandation_perso'])]
    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'recommandations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\ManyToOne(targetEntity: RecommandationLevel::class, inversedBy: 'recommandations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecommandationLevel $level = null;

    #[ORM\ManyToOne(targetEntity: RecommandationStatus::class)]
    #[ORM\JoinColumn(nullable: false, options: ['default' => 4])]
    private ?RecommandationStatus $status = null;

    #[ORM\OneToMany(mappedBy: 'recommandation', targetEntity: RecommandationResource::class)]
    private Collection $resources;

    #[ORM\OneToMany(mappedBy: 'recommandation', targetEntity: RecommandationSuccessIndicator::class)]
    private Collection $indicators;

    #[Groups(['recommandation_perso'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shortTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $details = null;

    #[ORM\ManyToMany(targetEntity: Answer::class, inversedBy: 'recommandations')]
    private Collection $answers;

    public function __construct()
    {
        $this->resources = new ArrayCollection();
        $this->indicators = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, RecommandationResource>
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(RecommandationResource $resource): static
    {
        if (!$this->resources->contains($resource)) {
            $this->resources->add($resource);
            $resource->setRecommandation($this);
        }

        return $this;
    }

    public function removeResource(RecommandationResource $resource): static
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getRecommandation() === $this) {
                $resource->setRecommandation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecommandationSuccessIndicator>
     */
    public function getIndicators(): Collection
    {
        return $this->indicators;
    }

    public function addIndicator(RecommandationSuccessIndicator $indicator): static
    {
        if (!$this->indicators->contains($indicator)) {
            $this->indicators->add($indicator);
            $indicator->setRecommandation($this);
        }

        return $this;
    }

    public function removeIndicator(RecommandationSuccessIndicator $indicator): static
    {
        if ($this->indicators->removeElement($indicator)) {
            // set the owning side to null (unless already changed)
            if ($indicator->getRecommandation() === $this) {
                $indicator->setRecommandation(null);
            }
        }

        return $this;
    }

    public function getShortTitle(): ?string
    {
        return $this->shortTitle;
    }

    public function setShortTitle(?string $shortTitle): static
    {
        $this->shortTitle = $shortTitle;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): static
    {
        $this->answers->removeElement($answer);

        return $this;
    }
}
