<?php

declare(strict_types=1);

namespace Wawibox\Service;

use Wawibox\Order\Order;
use Wawibox\Supplier\Supplier;
use Wawibox\PriceCalculator\PriceCalculator;

/**
 * Accepts a list of suppliers and an order.
 * Uses the PriceCalculator to compute total prices.
 * Returns the cheapest supplier and price.
 */
class SupplierComparisonService
{
    /**
     * @param Supplier[] $suppliers
     */
    public function __construct(
        private array $suppliers,
        private PriceCalculator $calculator
    ) {}

    public function findBestSupplier(Order $order): array
    {
        $bestSupplier = null;
        $lowestPrice = PHP_FLOAT_MAX;

        foreach ($this->suppliers as $supplier) {
            try {
                $price = $this->calculator->calculateTotalPrice($order, $supplier);
                if ($price < $lowestPrice) {
                    $lowestPrice = $price;
                    $bestSupplier = $supplier;
                }
            } catch (\RuntimeException $e) {
                // Supplier can't fulfill the order — skip
                continue;
            }
        }

        if (!$bestSupplier) {
            throw new \RuntimeException("No supplier can fulfill the order");
        }

        return [
            'supplier' => $bestSupplier,
            'price' => $lowestPrice
        ];
    }
}