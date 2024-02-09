<?php

namespace App\Entity;

use App\Repository\AttemptRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AttemptRepository::class)]
class Attempt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $score = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $startedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $endedAt = null;

    #[ORM\ManyToOne(inversedBy: 'attempts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quizz $quizz = null;

    #[ORM\ManyToOne(inversedBy: 'attempts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $player = null;

    #[ORM\ManyToOne(inversedBy: 'attempts')]
    private ?Question $currentQuestion = null;

    #[ORM\OneToMany(mappedBy: 'attempt', targetEntity: AttemptAnswer::class, orphanRemoval: true)]
    private Collection $attemptAnswers;

    public function __construct()
    {
        $this->attemptAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeImmutable $startedAt): static
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $endedAt): static
    {
        $this->endedAt = $endedAt;

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

    public function getPlayer(): ?User
    {
        return $this->player;
    }

    public function setPlayer(?User $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getCurrentQuestion(): ?Question
    {
        return $this->currentQuestion;
    }

    public function setCurrentQuestion(?Question $currentQuestion): static
    {
        $this->currentQuestion = $currentQuestion;

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
            $attemptAnswer->setAttempt($this);
        }

        return $this;
    }

    public function removeAttemptAnswer(AttemptAnswer $attemptAnswer): static
    {
        if ($this->attemptAnswers->removeElement($attemptAnswer)) {
            // set the owning side to null (unless already changed)
            if ($attemptAnswer->getAttempt() === $this) {
                $attemptAnswer->setAttempt(null);
            }
        }

        return $this;
    }
}
