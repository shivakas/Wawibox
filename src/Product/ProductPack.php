<?php

declare(strict_types=1);

namespace Wawibox\Product;

/**
 * Representing a pack of a product offered by a supplier.
 */
class ProductPack
{
    public function __construct(
        private string $productName,
        private int $unitCount,
        private float $price
    ) {
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getUnitCount(): int
    {
        return $this->unitCount;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
