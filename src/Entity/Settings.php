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
}
