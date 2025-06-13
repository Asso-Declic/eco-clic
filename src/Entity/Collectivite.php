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
    #[Groups(['collectivite', 'collectivite_status', 'link_demand', 'score'])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups(['collectivite', 'filters', 'link_demand'])]
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

    // Si le niveau 2 est activé, les utilisateurs de la collectivité pourront répondre à un questionnaire de niveau 2.
    #[Groups(['collectivite'])]
    #[ORM\Column(options: ['default' => false])]
    private ?bool $levelTwo = false;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $firstAnsweredAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $lastAnsweredAt = null;

    #[ORM\ManyToOne(inversedBy: 'linkDemands')]
    private ?OPSN $linkDemand = null;

    #[ORM\OneToMany(mappedBy: 'collectivite', targetEntity: Notification::class, orphanRemoval: true)]
    private Collection $notifications;

    public function __construct()
    {
        $this->collectiviteAnswers = new ArrayCollection();
        $this->scores = new ArrayCollection();
        $this->statuses = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->notifications = new ArrayCollection();
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

    public function isLevelTwo(): ?bool
    {
        return $this->levelTwo ?? false;
    }

    public function setLevelTwo(bool $levelTwo): self
    {
        $this->levelTwo = $levelTwo;

        return $this;
    }

    public function getFirstAnsweredAt(): ?\DateTimeImmutable
    {
        return $this->firstAnsweredAt;
    }

    public function setFirstAnsweredAt(?\DateTimeImmutable $firstAnsweredAt): static
    {
        $this->firstAnsweredAt = $firstAnsweredAt;

        return $this;
    }

    public function getLastAnsweredAt(): ?\DateTimeImmutable
    {
        return $this->lastAnsweredAt;
    }

    public function setLastAnsweredAt(?\DateTimeImmutable $lastAnsweredAt): static
    {
        $this->lastAnsweredAt = $lastAnsweredAt;

        return $this;
    }

    public function getLinkDemand(): ?OPSN
    {
        return $this->linkDemand;
    }

    public function setLinkDemand(?OPSN $linkDemand): static
    {
        $this->linkDemand = $linkDemand;

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setCollectiviteId($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getCollectiviteId() === $this) {
                $notification->setCollectiviteId(null);
            }
        }

        return $this;
    }
}
