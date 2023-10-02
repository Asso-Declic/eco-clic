<?php

namespace App\Entity;

use App\Repository\RecommandationActivatableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecommandationActivatableRepository::class)]
class RecommandationActivatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
