<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[Groups(['collectivite', 'department_browse', 'filters', 'opsn_browse'])]
    #[ORM\Id]
    #[ORM\Column(length: 3, options: ['fixed' => true])]
    private ?string $code = null;

    #[Groups(['department_browse', 'filters', 'opsn_browse'])]
    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[Groups(['opsn_browse'])]
    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'departements')]
    #[ORM\JoinColumn(name: 'region_code', referencedColumnName: 'code')]
    private ?Region $region = null;

    #[ORM\ManyToMany(targetEntity: OPSN::class, mappedBy: 'departements')]
    private Collection $OPSNs;

    #[ORM\OneToMany(targetEntity: Collectivite::class, mappedBy: 'departement')]
    private Collection $collectivites;

    public function __construct()
    {
        $this->OPSNs = new ArrayCollection();
        $this->collectivites = new ArrayCollection();
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

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

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

    /**
     * @return Collection<int, collectivite>
     */
    public function getcollectivites(): Collection
    {
        return $this->collectivites;
    }

    public function addCollectivite(Collectivite $collectivite): self
    {
        if (!$this->collectivites->contains($collectivite)) {
            $this->collectivites->add($collectivite);
            $collectivite->setDepartement($this);
        }

        return $this;
    }

    public function removecollectivite(Collectivite $collectivite): self
    {
        if ($this->collectivites->removeElement($collectivite)) {
            $collectivite->setDepartement(null);
        }

        return $this;
    }
}
