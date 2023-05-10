<?php

namespace App\Entity;

use App\Repository\CollectiviteTypeRepository;
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
}
