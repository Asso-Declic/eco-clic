<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
// #[ORM\Table(name: 'question')]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::GUID)]
    private ?int $id = null;

    #[ORM\Column(name: 'Question', length: 500, nullable: true)]
    private ?string $question = null;

    // #[ORM\Column(name: 'IdTheme', type: Types::GUID)]
    #[ORM\ManyToOne(targetEntity: Theme::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(name: 'IdTheme', nullable: false)]
    private ?Theme $theme = null;

    #[ORM\Column(name: 'IdCategorie', type: Types::GUID)]
    private ?string $category = null;

    #[ORM\Column(name: 'Multiple', options: ['default' => 0])]
    private ?bool $multiple = null;

    #[ORM\Column(name: 'Definition', type: Types::TEXT, nullable: true)]
    private ?string $definition = null;

    #[ORM\Column(name: 'InfoComplementaire', type: Types::TEXT, nullable: true)]
    private ?string $additionalInformation = null;

    #[ORM\Column(name: 'Titre_definition', type: Types::TEXT, nullable: true)]
    private ?string $definitionTitle = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, orphanRemoval: true)]
    private Collection $answers;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Recommandation::class)]
    private Collection $recommandations;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->recommandations = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
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
}
