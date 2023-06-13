<?php

namespace App\Entity;

use App\Repository\CollectiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CollectiviteRepository::class)]
class Collectivite
{
    #[Groups(['collectivite', 'collectivite_status', 'score'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['collectivite'])]
    #[ORM\Column(length: 500)]
    private ?string $name = null;

    #[Groups(['collectivite'])]
    #[ORM\Column]
    private ?int $population = null;

    #[Groups(['collectivite'])]
    #[ORM\ManyToOne(targetEntity: Departement::class, inversedBy: 'collectivites')]
    #[ORM\JoinColumn(referencedColumnName: 'code')]
    private ?Departement $departement = null;

    #[Groups(['collectivite'])]
    #[ORM\Column(length: 14, nullable: true, options: ['fixed' => true])]
    private ?string $siret = null;

    #[Groups(['collectivite'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $latitude = null;

    #[Groups(['collectivite'])]
    #[ORM\Column(length: 500, nullable: true)]
    private ?string $longitude = null;

    #[Groups(['collectivite'])]
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

    #[ORM\OneToMany(mappedBy: 'collectivite', targetEntity: CollectiviteStatus::class)]
    private Collection $statuses;

    #[Groups(['collectivite'])]
    #[ORM\Column(length: 5, nullable: true)]
    private ?string $postalCode = null;

    public function __construct()
    {
        $this->collectiviteAnswers = new ArrayCollection();
        $this->scores = new ArrayCollection();
        $this->statuses = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    /**
     * Trouve le statut d'une recommandation dans la collection
     *
     * @param Recommandation $recommandation
     * @return CollectiviteStatus|null
     */
    public function getStatus(Recommandation $recommandation): ?CollectiviteStatus
    {
        foreach ($this->getStatuses() as $status) {
            if ($status->getRecommandation() === $recommandation) {
                return $status;
            }
        }
        return null;
    }

    /**
     * @return Collection<int, CollectiviteStatus>
     */
    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    public function addStatus(CollectiviteStatus $status): self
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses->add($status);
            $status->setCollectivite($this);
        }

        return $this;
    }

    public function removeStatus(CollectiviteStatus $status): self
    {
        if ($this->statuses->removeElement($status)) {
            // set the owning side to null (unless already changed)
            if ($status->getCollectivite() === $this) {
                $status->setCollectivite(null);
            }
        }

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }
}
