<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'utilisateur')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Id', type: 'guid')]
    private ?int $id = null;

    #[ORM\Column(name: 'Identifiant', length: 300, unique: true)]
    private ?string $username = null;

    //#[ORM\Column]
    // La BDD d'origine n'a pas de rôle alors on commente l'attribut qui en créerait une
    // Il faut impérativement laisser cette propriété pour respecter le `UserInterface`
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(name: 'MotDePasse', length: 200, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(name: 'Mail', length: 200, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(name: 'Nom', length: 50, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(name: 'Prenom', length: 50, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(name: 'CollectiviteId',type: Types::GUID, nullable: true)]
    private ?string $collectivite = null;

    #[ORM\Column(name: 'Admin')]
    private bool $admin = false;

    #[ORM\Column(name: 'Token',length: 500, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(name: 'Actif')]
    private ?bool $active = null;

    #[ORM\Column(name: 'IdMotDePasseOublie', type: Types::GUID, nullable: true)]
    private ?string $forgotPasswordId = null;

    #[ORM\Column(name: 'DateMotDePasseOublie', nullable: true)]
    private ?\DateTimeImmutable $forgotPasswordAt = null;

    #[ORM\Column(name: 'CGU', options: ['default'=>false])]
    private bool $cguChecked = false;

    #[ORM\Column(name: 'IsVerifie', options: ['default'=>false])]
    private bool $verified = false;

    public function getId(): ?int
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
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getCollectivite(): ?string
    {
        return $this->collectivite;
    }

    public function setCollectivite(?string $collectivite): self
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

    public function getForgotPasswordId(): ?string
    {
        return $this->forgotPasswordId;
    }

    public function setForgotPasswordId(?string $forgotPasswordId): self
    {
        $this->forgotPasswordId = $forgotPasswordId;

        return $this;
    }

    public function getForgotPasswordAt(): ?\DateTimeImmutable
    {
        return $this->forgotPasswordAt;
    }

    public function setForgotPasswordAt(?\DateTimeImmutable $forgotPasswordAt): self
    {
        $this->forgotPasswordAt = $forgotPasswordAt;

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
}