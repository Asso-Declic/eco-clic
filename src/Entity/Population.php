<?php

namespace App\Entity;

use App\Repository\PopulationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PopulationRepository::class)]
class Population
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'populations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CollectiviteType $collectiviteType = null;

    #[ORM\Column]
    private ?int $min = null;

    #[ORM\Column(nullable: true)]
    private ?int $max = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollectiviteType(): ?CollectiviteType
    {
        return $this->collectiviteType;
    }

    public function setCollectiviteType(?CollectiviteType $collectiviteType): self
    {
        $this->collectiviteType = $collectiviteType;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(?int $max): self
    {
        $this->max = $max;

        return $this;
    }
}
