<?php

declare(strict_types= 1);

namespace Wawibox\Order;

class OrderItem
{
    public function __construct(
        private string $productName,
        private int $quantity
    ) {}

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}