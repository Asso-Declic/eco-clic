<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    public const TYPE_BUTTON = 'button';
    public const TYPE_INPUT = 'input';

    #[Groups(['answer', 'collectiviteAnswer', 'question'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['answer', 'question'])]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type = null;

    #[Groups(['answer', 'question', 'collectiviteAnswer'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;
    
    #[Groups(['answer'])]
    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[Groups(['answer', 'question'])]
    #[ORM\Column(nullable: true)]
    private ?int $ponderation = null;

    #[ORM\OneToMany(mappedBy: 'answer', targetEntity: CollectiviteAnswer::class)]
    private Collection $collectiviteAnswers;

    #[ORM\OneToMany(mappedBy: 'parentAnswer', targetEntity: Question::class)]
    private Collection $dependentQuestions;

    #[ORM\ManyToMany(targetEntity: Recommandation::class, mappedBy: 'answers')]
    private Collection $recommandations;

    public function __construct()
    {
        $this->dependentQuestions = new ArrayCollection();
        $this->recommandations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->body ?? '';
    }

    public function getId(): ?string
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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
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

    /**
     * @return Collection<int, Question>
     */
    public function getDependentQuestions(): Collection
    {
        return $this->dependentQuestions;
    }

    public function addDependentQuestion(Question $dependentQuestion): self
    {
        if (!$this->dependentQuestions->contains($dependentQuestion)) {
            $this->dependentQuestions->add($dependentQuestion);
            $dependentQuestion->setParentAnswer($this);
        }

        return $this;
    }

    public function removeDependentQuestion(Question $dependentQuestion): self
    {
        if ($this->dependentQuestions->removeElement($dependentQuestion)) {
            // set the owning side to null (unless already changed)
            if ($dependentQuestion->getParentAnswer() === $this) {
                $dependentQuestion->setParentAnswer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CollectiviteAnswer>
     */
    public function getCollectiviteAnswers(): Collection
    {
        return $this->collectiviteAnswers;
    }

    public function addCollectiviteAnswer(CollectiviteAnswer $collectiviteAnswer): self
    {
        if (!$this->collectiviteAnswers->contains($collectiviteAnswer)) {
            $this->collectiviteAnswers->add($collectiviteAnswer);
            $collectiviteAnswer->setAnswer($this);
        }

        return $this;
    }

    public function removeCollectiviteAnswer(CollectiviteAnswer $collectiviteAnswer): self
    {
        if ($this->collectiviteAnswers->removeElement($collectiviteAnswer)) {
            // set the owning side to null (unless already changed)
            if ($collectiviteAnswer->getAnswer() === $this) {
                $collectiviteAnswer->setAnswer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recommandation>
     */
    public function getRecommandations(): Collection
    {
        return $this->recommandations;
    }

    public function addRecommandation(Recommandation $recommandation): static
    {
        if (!$this->recommandations->contains($recommandation)) {
            $this->recommandations->add($recommandation);
            $recommandation->addAnswer($this);
        }

        return $this;
    }

    public function removeRecommandation(Recommandation $recommandation): static
    {
        if ($this->recommandations->removeElement($recommandation)) {
            $recommandation->removeAnswer($this);
        }

        return $this;
    }
}
