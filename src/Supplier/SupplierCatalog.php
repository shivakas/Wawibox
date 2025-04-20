<?php

declare(strict_types=1);

namespace Wawibox\Supplier;

use Wawibox\Order\OrderItem;
use Wawibox\Product\ProductPack;
use Wawibox\Supplier\Supplier;

/**
 * Supplier repository
 */
class SupplierCatalog
{
   /**
    * @return Supplier[]
    */
    public static function getSupplierCatalog(): array
    {
        $supplierA = new Supplier('Supplier A', [
            new ProductPack(OrderItem::DENTAL_FLOSS, 1, 9.00),
            new ProductPack(OrderItem::DENTAL_FLOSS, 20, 160.00),
            new ProductPack(OrderItem::IBUROFEN, 1, 5.00),
            new ProductPack(OrderItem::IBUROFEN, 10, 48.00),
        ]);

        $supplierB = new Supplier('Supplier B', [
            new ProductPack(OrderItem::DENTAL_FLOSS, 1, 8.00),
            new ProductPack(OrderItem::DENTAL_FLOSS, 10, 71.00),
            new ProductPack(OrderItem::IBUROFEN, 1, 6.00),
            new ProductPack(OrderItem::IBUROFEN, 5, 25.00),
            new ProductPack(OrderItem::IBUROFEN, 100, 410.00),
        ]);

        return [$supplierA, $supplierB];
    }
}
