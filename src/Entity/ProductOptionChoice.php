<?php

namespace App\Entity;

use App\Repository\ProductOptionChoiceRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductOptionChoiceRepository::class)
 */
class ProductOptionChoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private string $price;

    /**
     * een ProductOptionChoice heeft een ProductOption, een ProductOption kan tot meerdere ProductOptionChoices behoren
     * @ORM\ManyToOne(targetEntity="ProductOption", inversedBy="productOptionChoices")
     */
    private $productoption;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=CartOption::class, mappedBy="productOptionChoice")
     */
    private $cartOptions;

    public function __construct()
    {
        $this->setCreatedAt(new DateTime());
        $this->setUpdatedAt(new DateTime());
        $this->cartOptions = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->getName();
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedAtValue()
    {
        $this->setCreatedAt(new DateTime());
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setUpdatedAtValue()
    {
        $this->setUpdatedAt(new DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProductoption()
    {
        return $this->productoption;
    }

    public function setProductoption($productoption): self
    {
        $this->productoption = $productoption;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|CartOption[]
     */
    public function getCartOptions(): Collection
    {
        return $this->cartOptions;
    }

    public function addCartOption(CartOption $cartOption): self
    {
        if (!$this->cartOptions->contains($cartOption)) {
            $this->cartOptions[] = $cartOption;
            $cartOption->setProductOptionChoice($this);
        }

        return $this;
    }

    public function removeCartOption(CartOption $cartOption): self
    {
        if ($this->cartOptions->removeElement($cartOption)) {
            // set the owning side to null (unless already changed)
            if ($cartOption->getProductOptionChoice() === $this) {
                $cartOption->setProductOptionChoice(null);
            }
        }

        return $this;
    }
}
