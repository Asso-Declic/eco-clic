<?php

namespace App\Entity;

use App\Repository\OPSNRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OPSNRepository::class)]
#[ORM\Table(name: 'OPSN')]
class OPSN
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Id', type: Types::GUID)]
    private ?int $id = null;

    #[ORM\Column(name: 'Nom', length: 500)]
    private ?string $name = null;

    #[ORM\Column(name: 'Mail', length: 500, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(name: 'DepartementCode', length: 3, options: ['fixed' => true])]
    private ?string $departement = null;

    #[ORM\Column(name: 'Actif')]
    private ?bool $active = null;

    #[ORM\Column(name: 'Logo', length: 500, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(name: 'Telephone', nullable: true)]
    private ?int $phoneNumber = null;

    #[ORM\Column(name: 'Adresse', length: 500, nullable: true)]
    private ?string $postalAddress = null;

    #[ORM\Column(name: 'Site_Internet', length: 500, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(name: 'Siret', length: 14, nullable: true, options: ['fixed' => true])]
    private ?string $siret = null;

    #[ORM\Column(name: 'Latitude', length: 500, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(name: 'Longitude', length: 500, nullable: true)]
    private ?string $longitude = null;

    #[ORM\ManyToMany(targetEntity: Departement::class, inversedBy: 'OPSNs')]
    #[ORM\JoinTable(name: 'OPSN_Departement')]
    #[ORM\JoinColumn(name: 'OPSNId', referencedColumnName: 'Id')]
    #[ORM\InverseJoinColumn(name: 'DepartementCode', referencedColumnName: 'Code')]
    private Collection $departements;

    public function __construct()
    {
        $this->departements = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(string $postalAddress): self
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection<int, Departement>
     */
    public function getDepartements(): Collection
    {
        return $this->departements;
    }

    public function addDepartement(Departement $departement): self
    {
        if (!$this->departements->contains($departement)) {
            $this->departements->add($departement);
        }

        return $this;
    }

    public function removeDepartement(Departement $departement): self
    {
        $this->departements->removeElement($departement);

        return $this;
    }
}
