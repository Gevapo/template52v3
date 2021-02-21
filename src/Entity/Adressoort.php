<?php

namespace App\Entity;

use App\Repository\AdressoortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdressoortRepository::class)
 */
class Adressoort
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Adres::class, mappedBy="adressoort", orphanRemoval=true)
     */
    private $adressen;

    public function __construct()
    {
        $this->adressen = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Adres[]
     */
    public function getAdressen(): Collection
    {
        return $this->adressen;
    }

    public function addAdressen(Adres $adressen): self
    {
        if (!$this->adressen->contains($adressen)) {
            $this->adressen[] = $adressen;
            $adressen->setAdressoort($this);
        }

        return $this;
    }

    public function removeAdressen(Adres $adressen): self
    {
        if ($this->adressen->removeElement($adressen)) {
            // set the owning side to null (unless already changed)
            if ($adressen->getAdressoort() === $this) {
                $adressen->setAdressoort(null);
            }
        }

        return $this;
    }
}
