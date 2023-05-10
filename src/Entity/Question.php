<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
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

    #[ORM\Column(name: 'IdTheme', type: Types::GUID)]
    private ?string $theme = null;

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

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
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
}
