<?php

namespace App\Entity;

use App\Repository\CartOptionRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartOptionRepository::class)
 */
class CartOption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CartItem::class, inversedBy="cartOptions")
     */
    private $cartItem;

    /**
     * @ORM\ManyToOne(targetEntity=ProductOption::class, inversedBy="cartOptions")
     */
    private $productOption;

    /**
     * @ORM\ManyToOne(targetEntity=ProductOptionChoice::class, inversedBy="cartOptions")
     */
    private $productOptionChoice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct(ProductOption $productOption)
    {
        $this->setCreatedAt(new DateTime());
        $this->setUpdatedAt(new DateTime());
        $this->productOption = $productOption;
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

    public function getCartItem(): ?CartItem
    {
        return $this->cartItem;
    }

    public function setCartItem(?CartItem $cartItem): self
    {
        $this->cartItem = $cartItem;

        return $this;
    }

    public function getProductOption(): ?ProductOption
    {
        return $this->productOption;
    }

    public function setProductOption(?ProductOption $productOption): self
    {
        $this->productOption = $productOption;

        return $this;
    }

    public function getProductOptionChoice(): ?ProductOptionChoice
    {
        return $this->productOptionChoice;
    }

    public function setProductOptionChoice(?ProductOptionChoice $productOptionChoice): self
    {
        $this->productOptionChoice = $productOptionChoice;

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
}
