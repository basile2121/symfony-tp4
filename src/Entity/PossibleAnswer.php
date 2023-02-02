<?php

namespace App\Entity;

use App\Repository\PossibleAnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PossibleAnswerRepository::class)]
class PossibleAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(
        max: 255,
        maxMessage: 'Your type cannot be longer than {{ limit }} characters'
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[Assert\Length(
        max: 255,
        maxMessage: 'Your answer cannot be longer than {{ limit }} characters'
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $answer = null;

    #[ORM\ManyToMany(targetEntity: Question::class, mappedBy: 'possibleAnswer')]
    private Collection $questions;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;


    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        max: 50,
        maxMessage: 'Your basile cannot be longer than {{ limit }} characters'
    )]
    #[ORM\Column(length: 50)]
    private ?string $balise = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->addPossibleAnswer($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            $question->removePossibleAnswer($this);
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

    public function getBalise(): ?string
    {
        return $this->balise;
    }

    public function setBalise(string $balise): self
    {
        $this->balise = $balise;

        return $this;
    }

    public function __toString(): string
    {
        return $this->answer . ' / ' . $this->type. ' / ' . $this->balise;
    }

}
