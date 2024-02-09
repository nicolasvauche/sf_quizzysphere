<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quizz $quizz = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, orphanRemoval: true)]
    #[ORM\OrderBy(['position' => 'ASC'])]
    private Collection $answers;

    #[ORM\OneToMany(mappedBy: 'currentQuestion', targetEntity: Attempt::class)]
    private Collection $attempts;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: AttemptAnswer::class, orphanRemoval: true)]
    private Collection $attemptAnswers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->attempts = new ArrayCollection();
        $this->attemptAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): static
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): static
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Attempt>
     */
    public function getAttempts(): Collection
    {
        return $this->attempts;
    }

    public function addAttempt(Attempt $attempt): static
    {
        if (!$this->attempts->contains($attempt)) {
            $this->attempts->add($attempt);
            $attempt->setCurrentQuestion($this);
        }

        return $this;
    }

    public function removeAttempt(Attempt $attempt): static
    {
        if ($this->attempts->removeElement($attempt)) {
            // set the owning side to null (unless already changed)
            if ($attempt->getCurrentQuestion() === $this) {
                $attempt->setCurrentQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AttemptAnswer>
     */
    public function getAttemptAnswers(): Collection
    {
        return $this->attemptAnswers;
    }

    public function addAttemptAnswer(AttemptAnswer $attemptAnswer): static
    {
        if (!$this->attemptAnswers->contains($attemptAnswer)) {
            $this->attemptAnswers->add($attemptAnswer);
            $attemptAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeAttemptAnswer(AttemptAnswer $attemptAnswer): static
    {
        if ($this->attemptAnswers->removeElement($attemptAnswer)) {
            // set the owning side to null (unless already changed)
            if ($attemptAnswer->getQuestion() === $this) {
                $attemptAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
