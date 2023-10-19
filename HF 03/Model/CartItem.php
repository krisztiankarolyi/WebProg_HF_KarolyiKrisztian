<?php

namespace Model;

class CartItem
{
    private Product $product;
    private int $quantity;

    /**
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function increaseQuantity()
    {
        $q = $this->getQuantity();
        if ($q < $this->getProduct()->getAvailableQuantity()) {
            $this->setQuantity($q + 1);

        }
    }

    public function decreaseQuantity()
    {
        $q = $this->getQuantity();
        if ($q > 1) {
            $this->setQuantity($q - 1);
        }
    }
}