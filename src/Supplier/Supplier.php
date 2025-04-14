<?php

declare(strict_types=1);

namespace Wawibox\Supplier;

use Wawibox\Product\ProductPack;

/**
 * Supplier class that holds the name and the list of ProductPacks it offers.
 */
class Supplier
{
    /**
     * @param ProductPack[] $productPacks
     */
    public function __construct(
        private string $name,
        private array $productPacks
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ProductPack[]
     */
    public function getProductPacks(): array
    {
        return $this->productPacks;
    }

    /**
     * Get all product packs for a given product name.
     *
     * @param string $productName
     * @return ProductPack[]
     */
    public function getProductPacksByName(string $productName): array
    {
        return array_filter(
            $this->productPacks,
            fn(ProductPack $pack) => $pack->getProductName() === $productName
        );
    }
}