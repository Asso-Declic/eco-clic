<?php

namespace App\Entity;

use App\Repository\RecommandationLevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RecommandationLevelRepository::class)]
class RecommandationLevel
{
    #[Groups(['recommandation_level'])]
    #[ORM\Id]
    #[ORM\Column(type: Types::SMALLINT, options: ['unsigned' => true])]
    private ?int $id = null;

    #[Groups(['recommandation_level'])]
    #[ORM\Column(length: 50)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: Recommandation::class)]
    private Collection $recommandations;

    #[Groups(['recommandation_level'])]
    #[ORM\Column(length: 20, nullable: true)]
    private ?string $color = null;

    public function __construct()
    {
        $this->recommandations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->label;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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
            $recommandation->setLevel($this);
        }

        return $this;
    }

    public function removeRecommandation(Recommandation $recommandation): self
    {
        if ($this->recommandations->removeElement($recommandation)) {
            // set the owning side to null (unless already changed)
            if ($recommandation->getLevel() === $this) {
                $recommandation->setLevel(null);
            }
        }

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
