<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
// #[ORM\Table(name: 'Departement')]
class Departement
{
    #[ORM\Id]
    #[ORM\Column(name: 'Code', length: 3, options: ['fixed' => true])]
    private ?string $code = null;

    #[ORM\Column(name: 'Nom',length: 100)]
    private ?string $name = null;

    #[ORM\Column(name: 'CodeRegion')]
    private ?int $regionCode = null;

    #[ORM\ManyToMany(targetEntity: OPSN::class, mappedBy: 'departements')]
    private Collection $OPSNs;

    public function __construct()
    {
        $this->OPSNs = new ArrayCollection();
    }

    /**
     * On garde getId pour respecter le standard des entités Doctrine
     */
    public function getId(): ?string
    {
        return $this->code;
    }

    public function getCode(): ?string
    {
        return $this->code;
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

    public function getRegionCode(): ?int
    {
        return $this->regionCode;
    }

    public function setRegionCode(int $regionCode): self
    {
        $this->regionCode = $regionCode;

        return $this;
    }

    /**
     * @return Collection<int, OPSN>
     */
    public function getOPSNs(): Collection
    {
        return $this->OPSNs;
    }

    public function addOPSN(OPSN $oPSN): self
    {
        if (!$this->OPSNs->contains($oPSN)) {
            $this->OPSNs->add($oPSN);
            $oPSN->addDepartement($this);
        }

        return $this;
    }

    public function removeOPSN(OPSN $oPSN): self
    {
        if ($this->OPSNs->removeElement($oPSN)) {
            $oPSN->removeDepartement($this);
        }

        return $this;
    }
}
