<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'video', schema: 'stwitcho')]
#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\NotBlank(message: 'Le titre est obligatoire.')]
    #[Assert\Length(
        min: 3,
        max: 25,
        minMessage: 'Le titre doit comporter au moins {{ limit }} caractères.',
        maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères.',
    )]
    private ?string $titre = null;

    #[ORM\Column(length: 5)]
    #[Assert\NotBlank(message: 'La durée est obligatoire.')]
    #[Assert\Type(type: 'numeric', message: 'La durée doit être un nombre de minutes.')]
    #[Assert\Positive(message: 'La durée doit être positive.')]
    #[Assert\LessThanOrEqual(value: 120, message: 'La vidéo ne peut pas dépasser deux heures.')]
    private ?string $duree = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_vues = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_like = null;

    #[ORM\Column]
    private ?bool $live = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(name: 'membre_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private ?Membre $id_membre = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'videos')]
    #[Assert\Count(
        min: 1,
        max: 3,
        minMessage: 'Sélectionnez au moins {{ limit }} catégorie.',
        maxMessage: 'Vous ne pouvez pas sélectionner plus de {{ limit }} catégories.',
    )]
    private Collection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getNbVues(): ?int
    {
        return $this->nb_vues;
    }

    public function setNbVues(?int $nb_vues): static
    {
        $this->nb_vues = $nb_vues;

        return $this;
    }

    public function getNbLike(): ?int
    {
        return $this->nb_like;
    }

    public function setNbLike(?int $nb_like): static
    {
        $this->nb_like = $nb_like;

        return $this;
    }

    public function isLive(): ?bool
    {
        return $this->live;
    }

    public function setLive(bool $live): static
    {
        $this->live = $live;

        return $this;
    }

    public function getIdMembre(): ?Membre
    {
        return $this->id_membre;
    }

    public function setIdMembre(?Membre $id_membre): static
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addVideo($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeVideo($this);
        }

        return $this;
    }
}