<?php

declare(strict_types= 1);

namespace Wawibox\PriceCalculator;

use Wawibox\Order\Order;
use Wawibox\Supplier\Supplier;
use Wawibox\Product\ProductPack;

/**
 * Takes an order and a supplier
 * Finds the cheapest combination of packs to fulfill each product in the order.
 * Returns the total cost for the supplier.
 * Throws an exception if the supplier can’t fulfill the order.
 */
class PriceCalculator
{
    public function calculateTotalPrice(Order $order, Supplier $supplier): float
    {
        $total = 0.0;

        foreach ($order->getItems() as $item) {
            $productName = $item->getProductName();
            $requiredUnits = $item->getQuantity();
            $packs = $supplier->getProductPacksByName($productName);

            if (empty($packs)) {
                throw new \RuntimeException("Supplier '{$supplier->getName()}' does not offer {$item->getProductName()}");
            }

            // Sort: bigger packs first, then cheaper per unit
            usort($packs, function (ProductPack $a, ProductPack $b) {
                if ($a->getUnitCount() === $b->getUnitCount()) {
                    return ($a->getPrice() / $a->getUnitCount()) <=> ($b->getPrice() / $b->getUnitCount());
                }
                return $b->getUnitCount() <=> $a->getUnitCount(); // Desc by size
            });

            $remaining = $requiredUnits;
            $cost = 0.0;

            foreach ($packs as $pack) {
                if ($remaining <= 0) {
                    break;
                }

                $unitsPerPack = $pack->getUnitCount();
                $numPacks = intdiv($remaining, $unitsPerPack);

                if ($numPacks > 0) {
                    $cost += $numPacks * $pack->getPrice();
                    $remaining -= $numPacks * $unitsPerPack;
                }
            }

            // Try to cover remainder using smallest pack
            if ($remaining > 0) {
                foreach ($packs as $pack) {
                    if ($pack->getUnitCount() >= $remaining) {
                        $cost += $pack->getPrice();
                        $remaining -= $pack->getUnitCount();
                        break;
                    }
                }
            }

            if ($remaining > 0) {
                throw new \RuntimeException("Supplier '{$supplier->getName()}' cannot fulfill {$requiredUnits} units of {$productName}");
            }

            $total += $cost;
        }

        return round($total, 2);
    }
}