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
    // La BDD d'origine n'a pas de rôle alors on commente l'attribut qui en créerait une
    // Il faut impérativement laisser cette propriété pour respecter le `UserInterface`
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 200, nullable: true)]
    private ?string $password = null;

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

    #[ORM\Column]
    private bool $admin = false;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $token = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(options: ['default'=>false])]
    private bool $cguChecked = false;

    #[ORM\Column( options: ['default'=>false])]
    private bool $verified = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserPreference::class, orphanRemoval: true)]
    private Collection $userPreferences;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $superAdmin = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $superAdmin2 = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?OPSN $opsn = null;

    public function __construct()
    {
        $this->userPreferences = new ArrayCollection();
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
     * Sans modifier la base de données, on peut vérifier l'état $admin pour ajouter le ROLE_ADMIN
     * Ça permet de garder les deux logiques jusqu'à ce qu'une meilleure solution soit développée
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        if ($this->admin) {
            $roles[] = 'ROLE_COLLECTIVITE_ADMIN';
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

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

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

    public function isSuperAdmin(): ?bool
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(bool $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }

    public function isSuperAdmin2(): ?bool
    {
        return $this->superAdmin2;
    }

    public function setSuperAdmin2(bool $superAdmin2): self
    {
        $this->superAdmin2 = $superAdmin2;

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
}
