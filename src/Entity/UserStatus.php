<?php

namespace App\Entity;

use App\Repository\UserStatusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserStatusRepository::class)]
class UserStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::GUID)]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recommandation $recommandation = null;

    #[ORM\ManyToOne(inversedBy: 'statuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $code = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }
}
