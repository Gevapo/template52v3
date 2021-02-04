<?php

namespace App\Entity;

use App\Repository\CartItemRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartItemRepository::class)
 */
class CartItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount = 1;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="cartItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity=CartOption::class, mappedBy="cartItem", cascade={"persist", "remove"})
     */
    private $cartOptions;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    public function __construct(Product $product)
    {
        $this->setCreatedAt(new DateTime());
        $this->setUpdatedAt(new DateTime());

        /*
         * Omdat het gedrag van een CartItem afhankelijk is van de Product entity
         * heb ik er voor gekozen om het Product aan de constructor mee te geven
         * en direct een array van CartOptions aan te maken aan de hand van de
         * options van het Product.
         */
        $this->product = $product;
        $this->cartOptions = new ArrayCollection();

        /*
         * Voeg net zoveel CartOption enitities toe aan de $options collection
         * als het aantal ProductOptions dat $product heeft.
         */
        foreach ($product->getProductoptions() as $option) {
            $this->addCartOption(new CartOption($option));
        }
        
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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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
            $cartOption->setCartItem($this);
        }

        return $this;
    }

    public function removeCartOption(CartOption $cartOption): self
    {
        if ($this->cartOptions->removeElement($cartOption)) {
            // set the owning side to null (unless already changed)
            if ($cartOption->getCartItem() === $this) {
                $cartOption->setCartItem(null);
            }
        }

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
