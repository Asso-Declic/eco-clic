<?php

namespace App\Entity;

use App\Repository\CollectiviteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectiviteRepository::class)]
// #[ORM\Table(name: 'collectivite')]
class Collectivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::GUID)]
    private ?int $id = null;

    #[ORM\Column(name:'Nom', length: 500)]
    private ?string $name = null;

    #[ORM\Column(name:'Population')]
    private ?int $population = null;

    #[ORM\Column(name:'DepartementCode', length: 3, options: ['fixed' => true])]
    private ?string $departmentCode = null;

    #[ORM\Column(name:'Siret', length: 14, options: ['fixed' => true])]
    private ?string $siret = null;

    #[ORM\Column(name:'Latitude', length: 500)]
    private ?string $latitude = null;

    #[ORM\Column(name:'Longitude', length: 500)]
    private ?string $longitude = null;

    #[ORM\Column(name:'TypeId', type: Types::GUID)]
    private ?string $type = null;

    #[ORM\Column(name:'OPSNId', type: Types::GUID, nullable: true)]
    private ?string $opsn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getDepartmentCode(): ?string
    {
        return $this->departmentCode;
    }

    public function setDepartmentCode(string $departmentCode): self
    {
        $this->departmentCode = $departmentCode;

        return $this;
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

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOpsn(): ?string
    {
        return $this->opsn;
    }

    public function setOpsn(?string $opsn): self
    {
        $this->opsn = $opsn;

        return $this;
    }
}
