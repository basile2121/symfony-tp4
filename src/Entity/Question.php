<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Your type cannot be longer than {{ limit }} characters'
    )]
    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: PossibleAnswer::class, inversedBy: 'questions')]
    private Collection $possibleAnswer;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, orphanRemoval: true)]
    private Collection $answers;


    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;


    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Questionary::class, mappedBy: 'questions')]
    private Collection $questionaries;

    public function __construct()
    {
        $this->possibleAnswer = new ArrayCollection();
        $this->answers = new ArrayCollection();
        $this->questionaries = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, PossibleAnswer>
     */
    public function getPossibleAnswer(): Collection
    {
        return $this->possibleAnswer;
    }

    public function addPossibleAnswer(PossibleAnswer $possibleAnswer): self
    {
        if (!$this->possibleAnswer->contains($possibleAnswer)) {
            $this->possibleAnswer->add($possibleAnswer);
        }

        return $this;
    }

    public function removePossibleAnswer(PossibleAnswer $possibleAnswer): self
    {
        $this->possibleAnswer->removeElement($possibleAnswer);

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
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
            $questionary->addQuestion($this);
        }

        return $this;
    }

    public function removeQuestionary(Questionary $questionary): self
    {
        if ($this->questionaries->removeElement($questionary)) {
            $questionary->removeQuestion($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->label;
    }
}
