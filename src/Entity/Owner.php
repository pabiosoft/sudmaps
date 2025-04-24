<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OwnerRepository::class)]
class Owner extends BaseEntity
{

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<string, SavedLocation>
     */
    #[ORM\OneToMany(targetEntity: SavedLocation::class, mappedBy: 'owner')]
    private Collection $savedLocations;


    public function __construct()
    {
        $this->savedLocations = new ArrayCollection();
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
}
