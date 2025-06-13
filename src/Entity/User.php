<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Groups('user')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    #[ORM\Column(type: Types::GUID)]
    private ?string $id = null;

    #[Groups('user')]
    #[ORM\Column(length: 300, unique: true)]
    private ?string $username = null;

    //#[ORM\Column]
    // La BDD d'origine n'a pas de rôle alors on commente l'attribut qui créerait un champs dans la table
    // Il faut impérativement laisser cette propriété pour respecter le UserInterface
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 200, nullable: true)]
    private ?string $password = null;

    // Rien ne vérifie que l'email est unique, on peut donc avoir plusieurs comptes avec la même adresse
    #[Groups('user')]
    #[ORM\Column(length: 200, nullable: true)]
    private ?string $email = null;

    #[Groups('user')]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $lastName = null;

    #[Groups('user')]
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $firstName = null;
    
    // #[ORM\Column(name: 'CollectiviteId',type: Types::GUID, nullable: true)]
    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Collectivite $collectivite = null;

    #[Groups('user')]
    #[ORM\Column]
    private bool $adminCollectivite = false;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $token = null;

    #[Groups('user')]
    #[ORM\Column(options: ['default'=>false])]
    private bool $active = false;

    #[ORM\Column(options: ['default'=>false])]
    private bool $cguChecked = false;

    #[Groups('user')]
    #[ORM\Column(options: ['default'=>false])]
    private bool $verified = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserPreference::class, orphanRemoval: true)]
    private Collection $userPreferences;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $adminOpsn = false;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $superAdmin = false;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?OPSN $opsn = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CollectiviteAnswer::class)]
    private Collection $collectiviteAnswers;

    #[Groups('user')]
    #[ORM\Column(options: ['default' => false])]
    private ?bool $isVu = false;

    public function __construct()
    {
        $this->userPreferences = new ArrayCollection();
        $this->collectiviteAnswers = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * On garde cette fonction essentielle dans la gestion des droits avec Symfony
     * Sans modifier la base de données, on peut vérifier l'état $admin pour ajouter le ROLE_OPSN
     * Ça permet de garder les deux logiques jusqu'à ce qu'une meilleure solution soit développée
     * @see UserInterface
     */
    public function getRoles(): array
    {
        if ($this->isActive() == false) {
            return [];
        }

        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        if ($this->adminCollectivite) {
            $roles[] = 'ROLE_COLLECTIVITE';
        }
        
        if ($this->opsn != null) {
            $roles[] = 'ROLE_USER_OPSN';
            if ($this->adminOpsn) {
                $roles[] = 'ROLE_OPSN';
            }
            
            if ($this->superAdmin) {
                $roles[] = 'ROLE_SUPER_ADMIN';
            }
        }

        // On ajoute le ROLE_LEVELTWO si $levelTwo est true dans la collectivité
        // Ça permet d'utiliser les rôles pour bloquer l'accès à certaines pages
        if ($this->collectivite != null) {
            if ($this->collectivite->isLevelTwo()) {
                $roles[] = 'ROLE_LEVELTWO';
            }
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getCollectivite(): ?Collectivite
    {
        return $this->collectivite;
    }

    public function setCollectivite(?Collectivite $collectivite): self
    {
        $this->collectivite = $collectivite;

        return $this;
    }

    public function isAdminCollectivite(): ?bool
    {
        return $this->adminCollectivite;
    }

    public function setAdminCollectivite(bool $adminCollectivite): self
    {
        $this->adminCollectivite = $adminCollectivite;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

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

    public function isCguChecked(): ?bool
    {
        return $this->cguChecked;
    }

    public function setCguChecked(bool $cguChecked): self
    {
        $this->cguChecked = $cguChecked;

        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * @return Collection<int, UserPreference>
     */
    public function getUserPreferences(): Collection
    {
        return $this->userPreferences;
    }

    public function addUserPreference(UserPreference $userPreference): self
    {
        if (!$this->userPreferences->contains($userPreference)) {
            $this->userPreferences->add($userPreference);
            $userPreference->setUser($this);
        }

        return $this;
    }

    public function removeUserPreference(UserPreference $userPreference): self
    {
        if ($this->userPreferences->removeElement($userPreference)) {
            // set the owning side to null (unless already changed)
            if ($userPreference->getUser() === $this) {
                $userPreference->setUser(null);
            }
        }

        return $this;
    }

    public function isAdminOpsn(): ?bool
    {
        return $this->adminOpsn;
    }

    public function setAdminOpsn(bool $adminOpsn): self
    {
        $this->adminOpsn = $adminOpsn;

        return $this;
    }

    public function isSuperAdmin(): ?bool
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(bool $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

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
    
    public function IsVu():?bool
    {
        return $this->isVu;
    }
    
    public function setIsVu(bool $isVu):self
    {
        $this->isVu = $isVu;
    
        return $this;
    }

    /**
     * @return Collection<int, CollectiviteAnswer>
     */
    public function getCollectiviteAnswers(): Collection
    {
        return $this->collectiviteAnswers;
    }

    public function addCollectiviteAnswer(CollectiviteAnswer $collectiviteAnswer): static
    {
        if (!$this->collectiviteAnswers->contains($collectiviteAnswer)) {
            $this->collectiviteAnswers->add($collectiviteAnswer);
            $collectiviteAnswer->setUser($this);
        }

        return $this;
    }

    public function removeCollectiviteAnswer(CollectiviteAnswer $collectiviteAnswer): static
    {
        if ($this->collectiviteAnswers->removeElement($collectiviteAnswer)) {
            // set the owning side to null (unless already changed)
            if ($collectiviteAnswer->getUser() === $this) {
                $collectiviteAnswer->setUser(null);
            }
        }

        return $this;
    }
}
