<?php

namespace App\Entity;

use App\Repository\AdresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresRepository::class)
 */
class Adres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Adressoort::class, inversedBy="adressen")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adressoort;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $straatnaam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $huisnummer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresregel1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $woonplaats;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postcode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="adressen")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressoort(): ?Adressoort
    {
        return $this->adressoort;
    }

    public function setAdressoort(?Adressoort $adressoort): self
    {
        $this->adressoort = $adressoort;

        return $this;
    }

    public function getStraatnaam(): ?string
    {
        return $this->straatnaam;
    }

    public function setStraatnaam(?string $straatnaam): self
    {
        $this->straatnaam = $straatnaam;

        return $this;
    }

    public function getHuisnummer(): ?string
    {
        return $this->huisnummer;
    }

    public function setHuisnummer(?string $huisnummer): self
    {
        $this->huisnummer = $huisnummer;

        return $this;
    }

    public function getAdresregel1(): ?string
    {
        return $this->adresregel1;
    }

    public function setAdresregel1(?string $adresregel1): self
    {
        $this->adresregel1 = $adresregel1;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->woonplaats;
    }

    public function setWoonplaats(?string $woonplaats): self
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
