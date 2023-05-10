<?php

namespace App\Entity;

use App\Repository\UserPreferenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserPreferenceRepository::class)]
// #[ORM\Table(name: 'preference')]
class UserPreference
{
    #[ORM\Id]
    #[ORM\Column(name: 'UtilisateurId', type: Types::GUID)]
    private ?string $user = null;
    
    #[ORM\Id]
    #[ORM\Column(name: 'Code', length: 20)]
    private ?string $code = null;
    
    #[ORM\Column(name: 'Json', length: 2000, nullable: true)]
    private ?string $json = null;

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
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
}
