<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[Groups('category', 'score', 'stats')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups('category', 'score', 'stats')]
    #[ORM\Column(length: 200, nullable: true)]
    private ?string $name = null;

    #[Groups('category')]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $image = null;

    #[Groups('category')]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Groups('category')]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionLevel2 = null;

    #[Groups('category')]
    #[ORM\Column(nullable: true)]
    private ?int $sortOrder = null;

    #[Groups('category')]
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Theme::class)]
    private Collection $themes;

    #[Groups('category')]
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Question::class)]
    private Collection $questions;

    #[Groups('category')]
    #[ORM\Column(options: ['default' => false])]
    private ?bool $levelTwo = false;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->themes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name ?? '';
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionLevel2(): ?string
    {
        return $this->descriptionLevel2;
    }

    public function setDescriptionLevel2(?string $descriptionLevel2): self
    {
        $this->descriptionLevel2 = $descriptionLevel2;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(?int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes->add($theme);
            $theme->setCategory($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->themes->removeElement($theme)) {
            // set the owning side to null (unless already changed)
            if ($theme->getCategory() === $this) {
                $theme->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setCategory($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getCategory() === $this) {
                $question->setCategory(null);
            }
        }

        return $this;
    }

    public function isLevelTwo(): bool
    {
        return $this->levelTwo ?? false;
    }

    public function setLevelTwo(bool $levelTwo): self
    {
        $this->levelTwo = $levelTwo;

        return $this;
    }
}
