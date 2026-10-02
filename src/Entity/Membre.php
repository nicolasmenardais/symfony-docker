<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'membre', schema: 'stwitcho')]
#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $mel = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\Column(length: 15)]
    private ?string $Pseudo = null;

    #[ORM\Column(length: 100)]
    private ?string $photoProfil = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_creation_compte = null;

    #[ORM\Column]
    private ?bool $utilisateur_role = null;

    #[ORM\Column(length: 255)]
    private ?string $return = null;

    /**
     * @var Collection<int, Video>
     */
    #[ORM\OneToMany(targetEntity: Video::class, mappedBy: 'id_membre')]
    private Collection $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMel(): ?string
    {
        return $this->mel;
    }

    public function setMel(string $mel): static
    {
        $this->mel = $mel;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): static
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil(string $photoProfil): static
    {
        $this->photoProfil = $photoProfil;

        return $this;
    }

    public function getDateCreationCompte(): ?\DateTime
    {
        return $this->date_creation_compte;
    }

    public function setDateCreationCompte(\DateTime $date_creation_compte): static
    {
        $this->date_creation_compte = $date_creation_compte;

        return $this;
    }

    public function isUtilisateurRole(): ?bool
    {
        return $this->utilisateur_role;
    }

    public function setUtilisateurRole(bool $utilisateur_role): static
    {
        $this->utilisateur_role = $utilisateur_role;

        return $this;
    }

    public function getReturn(): ?string
    {
        return $this->return;
    }

    public function setReturn(string $return): static
    {
        $this->return = $return;

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setIdMembre($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getIdMembre() === $this) {
                $video->setIdMembre(null);
            }
        }

        return $this;
    }
}