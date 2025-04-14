<?php

declare(strict_types=1);

namespace Wawibox\Supplier;

use Wawibox\Product\ProductPack;
use Wawibox\Supplier\Supplier;

class SupplierCatalog
{
   /**
    * Summary of getSupplierCatalog
    * @return Supplier[]
    */
   public static function getSupplierCatalog(): array
   {
        $supplierA = new Supplier('Supplier A', [
            new ProductPack('Dental Floss', 1, 9.00),
            new ProductPack('Dental Floss', 20, 160.00),
            new ProductPack('Ibuprofen', 1, 5.00),
            new ProductPack('Ibuprofen', 10, 48.00),
        ]);
            
        $supplierB = new Supplier('Supplier B', [
            new ProductPack('Dental Floss', 1, 8.00),
            new ProductPack('Dental Floss', 10, 71.00),
            new ProductPack('Ibuprofen', 1, 6.00),
            new ProductPack('Ibuprofen', 5, 25.00),
            new ProductPack('Ibuprofen', 100, 410.00),
        ]);

        return [$supplierA, $supplierB];
    }
}