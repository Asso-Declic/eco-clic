<?php

namespace App\Entity;

use App\Repository\CollectiviteTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectiviteTypeRepository::class)]
// #[ORM\Table(name: 'ref_TypeCollectivite')]
class CollectiviteType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[ORM\Column(name: 'Nom', length: 250)]
    private ?string $label = null;

    #[ORM\OneToMany(targetEntity: Collectivite::class, mappedBy: 'type')]
    private Collection $collectivites;

    public function __construct()
    {
        $this->collectivites = new ArrayCollection();
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
}
