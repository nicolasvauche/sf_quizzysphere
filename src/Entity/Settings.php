<?php

namespace App\Entity;

use App\Repository\SettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?UserGroup $defaultUserGroup = null;

    #[ORM\Column(nullable: true)]
    private ?int $quizzQuestionsMax = null;

    #[ORM\Column(nullable: true)]
    private ?int $quizzAnswersMax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDefaultUserGroup(): ?UserGroup
    {
        return $this->defaultUserGroup;
    }

    public function setDefaultUserGroup(?UserGroup $defaultUserGroup): static
    {
        $this->defaultUserGroup = $defaultUserGroup;

        return $this;
    }

    public function getQuizzQuestionsMax(): ?int
    {
        return $this->quizzQuestionsMax;
    }

    public function setQuizzQuestionsMax(?int $quizzQuestionsMax): static
    {
        $this->quizzQuestionsMax = $quizzQuestionsMax;

        return $this;
    }

    public function getQuizzAnswersMax(): ?int
    {
        return $this->quizzAnswersMax;
    }

    public function setQuizzAnswersMax(?int $quizzAnswersMax): static
    {
        $this->quizzAnswersMax = $quizzAnswersMax;

        return $this;
    }
}
