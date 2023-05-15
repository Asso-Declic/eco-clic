<?php

namespace App\Entity;

use App\Repository\CollectiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectiviteRepository::class)]
class Collectivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::GUID)]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $population = null;

    #[ORM\ManyToOne(targetEntity: Departement::class, inversedBy: 'collectivites')]
    #[ORM\JoinColumn(referencedColumnName: 'code')]
    private ?Departement $departement = null;

    #[ORM\Column(length: 14, options: ['fixed' => true])]
    private ?string $siret = null;

    #[ORM\Column(length: 500)]
    private ?string $latitude = null;

    #[ORM\Column(length: 500)]
    private ?string $longitude = null;

    #[ORM\ManyToOne(targetEntity: CollectiviteType::class, inversedBy: 'collectivites')]
    #[ORM\JoinColumn]
    private ?CollectiviteType $type = null;

    #[ORM\ManyToOne(targetEntity: OPSN::class, inversedBy: 'collectivites')]
    #[ORM\JoinColumn(nullable: true)]
    private ?OPSN $opsn = null;

    #[ORM\OneToMany(mappedBy: 'collectivite', targetEntity: Score::class, orphanRemoval: true)]
    private Collection $scores;

    #[ORM\OneToMany(mappedBy: 'collectivite', targetEntity: CollectiviteAnswer::class, orphanRemoval: true)]
    private Collection $collectiviteAnswers;

    #[ORM\OneToMany(mappedBy: 'collectivite', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->scores = new ArrayCollection();
        $this->collectiviteAnswers = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

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

    public function getType(): ?CollectiviteType
    {
        return $this->type;
    }

    public function setType(?CollectiviteType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOpsn(): ?OPSN
    {
        return $this->opsn;
    }

    public function setOpsn(?OPSN $opsn): self
    {
        $this->opsn = $opsn;

        return $this;
    }

    /**
     * @return Collection<int, Score>
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores->add($score);
            $score->setCollectivite($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getCollectivite() === $this) {
                $score->setCollectivite(null);
            }
        }

        return $this;
    }

        /**
     * @return Collection<int, Score>
     */
    public function getCollectiviteAnswers(): Collection
    {
        return $this->collectiviteAnswers;
    }

    public function addcollectiviteAnswer(CollectiviteAnswer $collectiviteAnswer): self
    {
        if (!$this->collectiviteAnswers->contains($collectiviteAnswer)) {
            $this->collectiviteAnswers->add($collectiviteAnswer);
            $collectiviteAnswer->setCollectivite($this);
        }

        return $this;
    }

    public function removeCollectiviteAnswer(collectiviteAnswer $collectiviteAnswer): self
    {
        if ($this->collectiviteAnswers->removeElement($collectiviteAnswer)) {
            // set the owning side to null (unless already changed)
            if ($collectiviteAnswer->getCollectivite() === $this) {
                $collectiviteAnswer->setCollectivite(null);
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
            $user->setCollectivite($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCollectivite() === $this) {
                $user->setCollectivite(null);
            }
        }

        return $this;
    }
}
