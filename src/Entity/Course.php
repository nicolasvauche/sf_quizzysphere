<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields: ['name'])]
    private ?string $slug = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: QuizzCategory::class, inversedBy: 'courses')]
    private Collection $quizzCategories;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    #[ORM\ManyToMany(targetEntity: UserGroup::class, inversedBy: 'courses')]
    private Collection $userGroups;

    public function __construct()
    {
        $this->quizzCategories = new ArrayCollection();
        $this->userGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, QuizzCategory>
     */
    public function getQuizzCategories(): Collection
    {
        return $this->quizzCategories;
    }

    public function addQuizzCategory(QuizzCategory $quizzCategory): static
    {
        if(!$this->quizzCategories->contains($quizzCategory)) {
            $this->quizzCategories->add($quizzCategory);
        }

        return $this;
    }

    public function removeQuizzCategory(QuizzCategory $quizzCategory): static
    {
        $this->quizzCategories->removeElement($quizzCategory);

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return Collection<int, UserGroup>
     */
    public function getUserGroups(): Collection
    {
        return $this->userGroups;
    }

    public function addUserGroup(UserGroup $userGroup): static
    {
        if (!$this->userGroups->contains($userGroup)) {
            $this->userGroups->add($userGroup);
        }

        return $this;
    }

    public function removeUserGroup(UserGroup $userGroup): static
    {
        $this->userGroups->removeElement($userGroup);

        return $this;
    }
}
