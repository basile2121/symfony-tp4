<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 10,
        minMessage: 'Your first name must be {{ limit }} characters long',
        maxMessage: 'Your first name must be {{ limit }} characters long',
    )]
    #[ORM\Column(length: 10)]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Questionary $questionary = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Section $section = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HighSchool $highSchool = null;


    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;


    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        max: 255,
        maxMessage: 'The firstname cannot be longer than {{ limit }} characters'
    )]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        max: 255,
        maxMessage: 'The lastname cannot be longer than {{ limit }} characters'
    )]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Registration::class, orphanRemoval: true)]
    private Collection $registrations;


    public function __construct()
    {
        $this->setType('student');
        $this->registrations = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdP()
    {
        return parent::getId();
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getQuestionary(): ?Questionary
    {
        return $this->questionary;
    }

    public function setQuestionary(?Questionary $questionary): self
    {
        $this->questionary = $questionary;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getHighSchool(): ?HighSchool
    {
        return $this->highSchool;
    }

    public function setHighSchool(?HighSchool $highSchool): self
    {
        $this->highSchool = $highSchool;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): self
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations->add($registration);
            $registration->setStudent($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): self
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getStudent() === $this) {
                $registration->setStudent(null);
            }
        }

        return $this;
    }
}
