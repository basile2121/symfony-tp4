<?php

namespace App\Entity;

use App\Repository\EditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditionRepository::class)]
class Edition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\ManyToMany(targetEntity: Speaker::class, inversedBy: 'editions')]
    private Collection $speakers;

    #[ORM\OneToMany(mappedBy: 'edition', targetEntity: Questionary::class, orphanRemoval: true)]
    private Collection $questionaries;

    #[ORM\OneToMany(mappedBy: 'edition', targetEntity: Workshop::class, orphanRemoval: true)]
    private Collection $workshops;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->speakers = new ArrayCollection();
        $this->questionaries = new ArrayCollection();
        $this->workshops = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection<int, Speaker>
     */
    public function getSpeakers(): Collection
    {
        return $this->speakers;
    }

    public function addSpeaker(Speaker $speaker): self
    {
        if (!$this->speakers->contains($speaker)) {
            $this->speakers->add($speaker);
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): self
    {
        $this->speakers->removeElement($speaker);

        return $this;
    }

    /**
     * @return Collection<int, Questionary>
     */
    public function getQuestionaries(): Collection
    {
        return $this->questionaries;
    }

    public function addQuestionary(Questionary $questionary): self
    {
        if (!$this->questionaries->contains($questionary)) {
            $this->questionaries->add($questionary);
            $questionary->setEdition($this);
        }

        return $this;
    }

    public function removeQuestionary(Questionary $questionary): self
    {
        if ($this->questionaries->removeElement($questionary)) {
            // set the owning side to null (unless already changed)
            if ($questionary->getEdition() === $this) {
                $questionary->setEdition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Workshop>
     */
    public function getWorkshops(): Collection
    {
        return $this->workshops;
    }

    public function addWorkshop(Workshop $workshop): self
    {
        if (!$this->workshops->contains($workshop)) {
            $this->workshops->add($workshop);
            $workshop->setEdition($this);
        }

        return $this;
    }

    public function removeWorkshop(Workshop $workshop): self
    {
        if ($this->workshops->removeElement($workshop)) {
            // set the owning side to null (unless already changed)
            if ($workshop->getEdition() === $this) {
                $workshop->setEdition(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
