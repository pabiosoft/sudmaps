<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location extends BaseEntity
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $visibility = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<string, Landmark>
     */
    #[ORM\OneToMany(targetEntity: Landmark::class, mappedBy: 'location')]
    private Collection $landmarks;

    /**
     * @var Collection<string, SavedLocation>
     */
    #[ORM\OneToMany(targetEntity: SavedLocation::class, mappedBy: 'location')]
    private Collection $savedLocations;

    /**
     * @var Collection<string, Tag>
     */
    #[ORM\OneToMany(targetEntity: Tag::class, mappedBy: 'location')]
    private Collection $tags;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    private ?Owner $owner = null;

    public function __construct()
    {
        $this->landmarks = new ArrayCollection();
        $this->savedLocations = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    public function setVisibility(?string $visibility): static
    {
        $this->visibility = $visibility;

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
     * @return Collection<string, Landmark>
     */
    public function getLandmarks(): Collection
    {
        return $this->landmarks;
    }

    public function addLandmark(Landmark $landmark): static
    {
        if (!$this->landmarks->contains($landmark)) {
            $this->landmarks->add($landmark);
            $landmark->setLocation($this);
        }

        return $this;
    }

    public function removeLandmark(Landmark $landmark): static
    {
        if ($this->landmarks->removeElement($landmark)) {
            // set the owning side to null (unless already changed)
            if ($landmark->getLocation() === $this) {
                $landmark->setLocation(null);
            }
        }

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
            $savedLocation->setLocation($this);
        }

        return $this;
    }

    public function removeSavedLocation(SavedLocation $savedLocation): static
    {
        if ($this->savedLocations->removeElement($savedLocation)) {
            // set the owning side to null (unless already changed)
            if ($savedLocation->getLocation() === $this) {
                $savedLocation->setLocation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<string, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->setLocation($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getLocation() === $this) {
                $tag->setLocation(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
