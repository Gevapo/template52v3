<?php

namespace App\Entity;

use App\Repository\Test4Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Test4Repository::class)
 */
class Test4
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nummer;

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

    public function getNummer(): ?int
    {
        return $this->nummer;
    }

    public function setNummer(?int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }
}
