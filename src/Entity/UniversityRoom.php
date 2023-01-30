<?php

namespace App\Entity;

use App\Repository\UniversityRoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniversityRoomRepository::class)]
class UniversityRoom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $stage = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\OneToOne(mappedBy: 'universityRoom', cascade: ['persist', 'remove'])]
    private ?Workshop $workshop = null;

    public function getId(): ?int
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

    public function getStage(): ?int
    {
        return $this->stage;
    }

    public function setStage(int $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getWorkshop(): ?Workshop
    {
        return $this->workshop;
    }

    public function setWorkshop(Workshop $workshop): self
    {
        // set the owning side of the relation if necessary
        if ($workshop->getUniversityRoom() !== $this) {
            $workshop->setUniversityRoom($this);
        }

        $this->workshop = $workshop;

        return $this;
    }
}