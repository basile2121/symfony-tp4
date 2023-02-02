<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Workshop $workshop = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Timeslot $timeslot = null;


    #[ORM\Column]
    private ?\DateTimeImmutable $registerAt = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Student $student = null;

    public function __construct()
    {
        $this->registerAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkshop(): ?Workshop
    {
        return $this->workshop;
    }

    public function setWorkshop(?Workshop $workshop): self
    {
        $this->workshop = $workshop;

        return $this;
    }

    public function getTimeslot(): ?Timeslot
    {
        return $this->timeslot;
    }

    public function setTimeslot(?Timeslot $timeslot): self
    {
        $this->timeslot = $timeslot;

        return $this;
    }

    public function getRegisterAt(): ?\DateTimeImmutable
    {
        return $this->registerAt;
    }

    public function setRegisterAt(\DateTimeImmutable $registerAt): self
    {
        $this->registerAt = $registerAt;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
