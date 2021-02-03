<?php

namespace App\Entity;

use App\Repository\ProductOptionRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductOptionRepository::class)
 */
class ProductOption
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
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private ?string $label;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updatedAt;

    /**
     * een ProductOptionChoice heeft een ProductOption, een ProductOption kan tot meerdere ProductOptionChoices behoren
     * @ORM\OneToMany(targetEntity=ProductOptionChoice::class, mappedBy="productoption")
     */
    private $productOptionChoices;

    public function __construct()
    {
        $this->productOptionChoices = new ArrayCollection();
        $this->setCreatedAt(new DateTime());
        $this->setUpdatedAt(new DateTime());
    }

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

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

    public function getProductOptionChoices()
    {
        return $this->productOptionChoices;
    }

    public function addProductOptionChoice(ProductOptionChoice $productOptionChoice): self
    {
        if (!$this->productOptionChoices->contains($productOptionChoice)) {
            $this->productOptionChoices[] = $productOptionChoice;
            $productOptionChoice->setProductoption($this);
        }

        return $this;
    }

    public function removeProductOptionChoice(ProductOptionChoice $productOptionChoice): self
    {
        if ($this->productOptionChoices->removeElement($productOptionChoice)) {
            // set the owning side to null (unless already changed)
            if ($productOptionChoice->getProductoption() === $this) {
                $productOptionChoice->setProductoption(null);
            }
        }

        return $this;
    }
}
