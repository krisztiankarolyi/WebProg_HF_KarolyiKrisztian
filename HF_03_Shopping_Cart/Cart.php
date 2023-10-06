<?php
class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @param CartItem[] $items
     */
    public function __construct()
    {
        $this->items = [];
    }
    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        $cartItem = new CartItem($product, $quantity);
        $found = false;

        foreach ($this->items as $index => $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                $found = true;
                $currentQuantity = $item->getQuantity();
                $newQuantity = min($currentQuantity + $quantity, $product->getAvailableQuantity());
                $item->setQuantity($newQuantity);
                break;
            }
        }

        if (!$found) {
            $this->items[] = $cartItem;
        }

        return $cartItem;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        foreach ($this->items as $index => $cartItem) {
            if ($cartItem->getProduct() === $product) {
                if($cartItem->getQuantity() > 1)
                    unset($this->items[$index]);
                break;
            }
        }
    }

    /**
     * This returns total number of products added in cart
     * @return int
     */
    public function getTotalQuantity(): int
    {
        $totalItems = 0;
        foreach ($this->getItems() as $item){
            $totalItems += $item->getQuantity();
        }
        return  $totalItems;
    }

    /**
     * This returns total price of products added in cart
     * @return float
     */
    public function getTotalSum(): float
    {
        $sum = 0;
        foreach ($this->getItems() as $item){
            $sum += $item->getProduct()->getPrice() * $item->getQuantity();
        }
        return  $sum;
    }
}