<?php

namespace App\Entity;

use App\Repository\TemporarySiretRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemporarySiretRepository::class)]
// #[ORM\Table(name: 'Siret_Temporaire')]
class TemporarySiret
{
    #[ORM\Id]
    #[ORM\Column(name: 'Siret', length: 14, options: ['fixed' => true])]
    private ?string $siret = null;

    #[ORM\Column(name: 'Nom', length: 2000, nullable: true)]
    private ?string $name = null;

    public function getId(): ?string
    {
        return $this->siret;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
