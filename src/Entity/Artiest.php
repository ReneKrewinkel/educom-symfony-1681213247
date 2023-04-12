<?php

namespace App\Entity;

use App\Repository\ArtiestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtiestRepository::class)]
class Artiest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $naam = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $omschrijving = null;

    #[ORM\Column(length: 25)]
    private ?string $afbeelding_url = null;

    #[ORM\Column(length: 255)]
    private ?string $website = null;

    #[ORM\OneToMany(mappedBy: 'artiest', targetEntity: Optreden::class)]
    private Collection $optreden;

    #[ORM\OneToMany(mappedBy: 'voorprogramma', targetEntity: Optreden::class)]
    private Collection $voorprogramma;

    public function __construct()
    {
        $this->optreden = new ArrayCollection();
        $this->voorprogramma = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getAfbeeldingUrl(): ?string
    {
        return $this->afbeelding_url;
    }

    public function setAfbeeldingUrl(string $afbeelding_url): self
    {
        $this->afbeelding_url = $afbeelding_url;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection<int, Optreden>
     */
    public function getOptreden(): Collection
    {
        return $this->optreden;
    }

    public function addOptreden(Optreden $optreden): self
    {
        if (!$this->optreden->contains($optreden)) {
            $this->optreden->add($optreden);
            $optreden->setArtiest($this);
        }

        return $this;
    }

    public function removeOptreden(Optreden $optreden): self
    {
        if ($this->optreden->removeElement($optreden)) {
            // set the owning side to null (unless already changed)
            if ($optreden->getArtiest() === $this) {
                $optreden->setArtiest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Optreden>
     */
    public function getVoorprogramma(): Collection
    {
        return $this->voorprogramma;
    }

    public function addVoorprogramma(Optreden $voorprogramma): self
    {
        if (!$this->voorprogramma->contains($voorprogramma)) {
            $this->voorprogramma->add($voorprogramma);
            $voorprogramma->setVoorprogramma($this);
        }

        return $this;
    }

    public function removeVoorprogramma(Optreden $voorprogramma): self
    {
        if ($this->voorprogramma->removeElement($voorprogramma)) {
            // set the owning side to null (unless already changed)
            if ($voorprogramma->getVoorprogramma() === $this) {
                $voorprogramma->setVoorprogramma(null);
            }
        }

        return $this;
    }
}
