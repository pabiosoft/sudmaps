<?php

namespace App\Entity;

use App\Repository\SavedLocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SavedLocationRepository::class)]
class SavedLocation extends BaseEntity
{

    #[ORM\ManyToOne(inversedBy: 'savedLocations')]
    private ?Owner $owner = null;

    #[ORM\ManyToOne(inversedBy: 'savedLocations')]
    private ?Location $location = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $savedAt = null;


    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getSavedAt(): ?\DateTimeImmutable
    {
        return $this->savedAt;
    }

    public function setSavedAt(\DateTimeImmutable $savedAt): static
    {
        $this->savedAt = $savedAt;

        return $this;
    }
}
