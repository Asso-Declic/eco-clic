<?php

namespace App\Entity;

use App\Repository\CollectiviteTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CollectiviteTypeRepository::class)]
class CollectiviteType
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['collectivite'])]
    #[ORM\Column(length: 250)]
    private ?string $label = null;

    #[ORM\OneToMany(targetEntity: Collectivite::class, mappedBy: 'type')]
    private Collection $collectivites;

    #[ORM\OneToMany(mappedBy: 'collectiviteType', targetEntity: Population::class)]
    private Collection $populations;

    public function __construct()
    {
        $this->collectivites = new ArrayCollection();
        $this->populations = new ArrayCollection();
    }

    public function getId(): ?string
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
     * @return Collection<int, collectivite>
     */
    public function getcollectivites(): Collection
    {
        return $this->collectivites;
    }

    public function addCollectivite(Collectivite $collectivite): self
    {
        if (!$this->collectivites->contains($collectivite)) {
            $this->collectivites->add($collectivite);
            $collectivite->setType($this);
        }

        return $this;
    }

    public function removecollectivite(Collectivite $collectivite): self
    {
        if ($this->collectivites->removeElement($collectivite)) {
            $collectivite->setType(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Population>
     */
    public function getPopulations(): Collection
    {
        return $this->populations;
    }

    public function addPopulation(Population $population): self
    {
        if (!$this->populations->contains($population)) {
            $this->populations->add($population);
            $population->setCollectiviteType($this);
        }

        return $this;
    }

    public function removePopulation(Population $population): self
    {
        if ($this->populations->removeElement($population)) {
            // set the owning side to null (unless already changed)
            if ($population->getCollectiviteType() === $this) {
                $population->setCollectiviteType(null);
            }
        }

        return $this;
    }
}
