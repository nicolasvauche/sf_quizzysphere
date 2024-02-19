<?php

namespace App\Entity;

use App\Repository\QuizzCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: QuizzCategoryRepository::class)]
class QuizzCategory
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $children;

    private $temporaryDepth = 0;

    #[ORM\ManyToMany(targetEntity: Course::class, mappedBy: 'quizzCategories')]
    private Collection $courses;

    #[ORM\ManyToMany(targetEntity: Quizz::class, mappedBy: 'quizzCategories')]
    #[ORM\OrderBy(['level' => 'ASC'])]
    private Collection $quizzs;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->courses = new ArrayCollection();
        $this->quizzs = new ArrayCollection();
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

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): static
    {
        $this->cover = $cover;

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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): static
    {
        if(!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): static
    {
        if($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function getTemporaryDepth(): int
    {
        return $this->temporaryDepth;
    }

    public function setTemporaryDepth($depth): static
    {
        $this->temporaryDepth = $depth;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): static
    {
        if(!$this->courses->contains($course)) {
            $this->courses->add($course);
            $course->addQuizzCategory($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        if($this->courses->removeElement($course)) {
            $course->removeQuizzCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Quizz>
     */
    public function getQuizzs(): Collection
    {
        return $this->quizzs;
    }

    public function addQuizz(Quizz $quizz): static
    {
        if(!$this->quizzs->contains($quizz)) {
            $this->quizzs->add($quizz);
            $quizz->addQuizzCategory($this);
        }

        return $this;
    }

    public function removeQuizz(Quizz $quizz): static
    {
        if($this->quizzs->removeElement($quizz)) {
            $quizz->removeQuizzCategory($this);
        }

        return $this;
    }

    public function updateActiveRecursively(bool $active): void
    {
        $this->setActive($active);

        // Mise à jour des catégories enfants
        foreach($this->getChildren() as $child) {
            $child->updateActiveRecursively($active);
        }

        // Mise à jour des quizz associés
        foreach($this->getQuizzs() as $quizz) {
            $quizz->setActive($active);
        }
    }
}
