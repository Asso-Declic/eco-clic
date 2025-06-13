<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[Groups(['answer', 'category', 'recommandation_custom', 'question'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['category', 'recommandation_custom', 'question'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $question = null;

    #[ORM\ManyToOne(targetEntity: Theme::class, inversedBy: 'questions')]
    private ?Theme $theme = null;
    
    #[Groups(['question'])]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'questions')]
    private ?Category $category = null;

    #[Groups(['question'])]
    #[ORM\Column(options: ['default' => 0])]
    private ?bool $multiple = null;

    #[Groups(['question'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $definition = null;

    #[Groups(['question'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $additionalInformation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $definitionTitle = null;

    #[Groups(['question'])]
    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, orphanRemoval: true)]
    private Collection $answers;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Recommandation::class)]
    private Collection $recommandations;

    #[Groups(['question'])]
    #[ORM\Column]
    private ?int $sortOrder = null;

    #[Groups(['question'])]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $children;

    #[Groups(['question'])]
    #[ORM\ManyToOne(inversedBy: 'dependentQuestions')]
    private ?Answer $parentAnswer = null;

    #[Groups(['question'])]
    #[ORM\Column]
    private ?bool $levelTwo = null;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->recommandations = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->question;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

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

    public function isMultiple(): ?bool
    {
        return $this->multiple;
    }

    public function setMultiple(bool $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(?string $definition): self
    {
        $this->definition = $definition;

        return $this;
    }

    public function getAdditionalInformation(): ?string
    {
        return $this->additionalInformation;
    }

    public function setAdditionalInformation(?string $additionalInformation): self
    {
        $this->additionalInformation = $additionalInformation;

        return $this;
    }

    public function getDefinitionTitle(): ?string
    {
        return $this->definitionTitle;
    }

    public function setDefinitionTitle(?string $definitionTitle): self
    {
        $this->definitionTitle = $definitionTitle;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
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

    public function addRecommandation(Recommandation $recommandation): self
    {
        if (!$this->recommandations->contains($recommandation)) {
            $this->recommandations->add($recommandation);
            $recommandation->setQuestion($this);
        }

        return $this;
    }

    public function removeRecommandation(Recommandation $recommandation): self
    {
        if ($this->recommandations->removeElement($recommandation)) {
            // set the owning side to null (unless already changed)
            if ($recommandation->getQuestion() === $this) {
                $recommandation->setQuestion(null);
            }
        }

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function getParentAnswer(): ?Answer
    {
        return $this->parentAnswer;
    }

    public function setParentAnswer(?Answer $parentAnswer): self
    {
        $this->parentAnswer = $parentAnswer;

        return $this;
    }

    public function isLevelTwo(): ?bool
    {
        return $this->levelTwo;
    }

    public function setLevelTwo(bool $levelTwo): static
    {
        $this->levelTwo = $levelTwo;

        return $this;
    }
}
