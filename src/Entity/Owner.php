<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: OwnerRepository::class)]
class Owner extends BaseEntity implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: "json")]
    private array $roles = [];


    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<string, SavedLocation>
     */
    #[ORM\OneToMany(targetEntity: SavedLocation::class, mappedBy: 'owner')]
    private Collection $savedLocations;

    /**
     * @var Collection<int, Location>
     */
    #[ORM\OneToMany(targetEntity: Location::class, mappedBy: 'owner')]
    private Collection $locations;


    public function __construct()
    {
        $this->savedLocations = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }


    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        if (!in_array('ROLE_USER', $roles, true)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }


    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<string, SavedLocation>
     */
    public function getSavedLocations(): Collection
    {
        return $this->savedLocations;
    }

    public function addSavedLocation(SavedLocation $savedLocation): static
    {
        if (!$this->savedLocations->contains($savedLocation)) {
            $this->savedLocations->add($savedLocation);
            $savedLocation->setOwner($this);
        }

        return $this;
    }

    public function removeSavedLocation(SavedLocation $savedLocation): static
    {
        if ($this->savedLocations->removeElement($savedLocation)) {
            // set the owning side to null (unless already changed)
            if ($savedLocation->getOwner() === $this) {
                $savedLocation->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setOwner($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getOwner() === $this) {
                $location->setOwner(null);
            }
        }

        return $this;
    }
}
