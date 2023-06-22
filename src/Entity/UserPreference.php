<?php

namespace App\Entity;

use App\Repository\UserPreferenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserPreferenceRepository::class)]
class UserPreference
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userPreferences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;
    
    #[Groups(['userPreference'])]
    #[ORM\Id]
    #[ORM\Column(name: 'Code', length: 20)]
    private ?string $code = null;

    #[Groups(['userPreference'])]
    #[ORM\Column(name: 'Json', length: 2000, nullable: true)]
    private ?string $json = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getJson(): ?string
    {
        return $this->json;
    }

    public function setJson(?string $json): self
    {
        $this->json = $json;

        return $this;
    }

    #[Groups(['userPreference'])]
    public function getUserId()
    {
        return $this->getUser()->getId();
    }
}
