<?php

namespace App\Entity;

use App\Repository\OPSNRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OPSNRepository::class)]
class OPSN
{
    #[Groups(['link_demand', 'opsn_browse'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['link_demand', 'opsn_browse'])]
    #[ORM\Column(length: 500)]
    private ?string $name = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $email = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 3, options: ['fixed' => true])]
    private ?string $departement = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column]
    private ?bool $active = false;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $logo = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(nullable: true, length: 10, options: ['fixed' => true])]
    private ?string $phoneNumber = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $postalAddress = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $website = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 14, nullable: true, options: ['fixed' => true])]
    private ?string $siret = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $latitude = null;

    #[Groups(['opsn_browse'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $longitude = null;

    #[Groups(['opsn_browse'])]
    #[ORM\ManyToMany(targetEntity: Departement::class, inversedBy: 'OPSNs')]
    #[ORM\InverseJoinColumn(referencedColumnName: 'code')]
    private Collection $departements;

    #[ORM\OneToMany(mappedBy: 'opsn', targetEntity: Collectivite::class)]
    private Collection $collectivites;

    #[ORM\OneToMany(mappedBy: 'opsn', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'linkDemand', targetEntity: Collectivite::class)]
    private Collection $linkDemands;

    public function __construct()
    {
        $this->departements = new ArrayCollection();
        $this->collectivites = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->linkDemands = new ArrayCollection();
    }

    public function getId(): ?string
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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
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

    /**
     * @return Collection<int, Collectivite>
     */
    public function getCollectivites(): Collection
    {
        return $this->collectivites;
    }

    public function addCollectivite(Collectivite $collectivite): self
    {
        if (!$this->collectivites->contains($collectivite)) {
            $this->collectivites->add($collectivite);
            $collectivite->setOpsn($this);
        }

        return $this;
    }

    public function removeCollectivite(Collectivite $collectivite): self
    {
        if ($this->collectivites->removeElement($collectivite)) {
            // set the owning side to null (unless already changed)
            if ($collectivite->getOpsn() === $this) {
                $collectivite->setOpsn(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setOpsn($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getOpsn() === $this) {
                $user->setOpsn(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Collectivite>
     */
    public function getLinkDemands(): Collection
    {
        return $this->linkDemands;
    }

    public function addLinkDemand(Collectivite $linkDemand): static
    {
        if (!$this->linkDemands->contains($linkDemand)) {
            $this->linkDemands->add($linkDemand);
            $linkDemand->setLinkDemand($this);
        }

        return $this;
    }

    public function removeLinkDemand(Collectivite $linkDemand): static
    {
        if ($this->linkDemands->removeElement($linkDemand)) {
            // set the owning side to null (unless already changed)
            if ($linkDemand->getLinkDemand() === $this) {
                $linkDemand->setLinkDemand(null);
            }
        }

        return $this;
    }
}
