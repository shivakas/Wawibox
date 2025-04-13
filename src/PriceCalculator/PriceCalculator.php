<?php

declare(strict_types= 1);

namespace Wawibox\PriceCalculator;

use Wawibox\Order\Order;
use Wawibox\Supplier\Supplier;
use Wawibox\Product\ProductPack;

class PriceCalculator
{
    public function calculateTotalPrice(Order $order, Supplier $supplier): float
    {
        $total = 0.0;

        foreach ($order->getItems() as $item) {
            $packs = $supplier->getProductPacksByName($item->getProductName());

            // Sort by price per unit ascending
            usort($packs, fn(ProductPack $a, ProductPack $b) =>
                ($a->getPrice() / $a->getUnitCount()) <=> ($b->getPrice() / $b->getUnitCount())
            );

            $remaining = $item->getQuantity();
            $itemTotal = 0.0;

            foreach ($packs as $pack) {
                if ($remaining <= 0) break;

                $unitsPerPack = $pack->getUnitCount();
                $needed = intdiv($remaining, $unitsPerPack);
                if ($remaining % $unitsPerPack !== 0) {
                    $needed++; // Get one more pack to cover leftovers
                }

                $packsToUse = min($needed, ceil($remaining / $unitsPerPack));
                $actualUnits = $packsToUse * $unitsPerPack;

                $itemTotal += $packsToUse * $pack->getPrice();
                $remaining -= $packsToUse * $unitsPerPack;
            }

            $total += $itemTotal;
        }

        return $total;
    }
}