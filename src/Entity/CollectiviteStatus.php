<?php

namespace App\Entity;

use App\Repository\CollectiviteStatusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectiviteStatusRepository::class)]
class CollectiviteStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recommandation $recommandation = null;

    #[ORM\ManyToOne(inversedBy: 'statuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collectivite $collectivite = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecommandationStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecommandation(): ?Recommandation
    {
        return $this->recommandation;
    }

    public function setRecommandation(?Recommandation $recommandation): self
    {
        $this->recommandation = $recommandation;

        return $this;
    }

    public function getCollectivite(): ?Collectivite
    {
        return $this->collectivite;
    }

    public function setCollectivite(?Collectivite $collectivite): self
    {
        $this->collectivite = $collectivite;

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
}
