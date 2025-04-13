<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Wawibox\Supplier\Supplier;
use Wawibox\Product\ProductPack;

class SupplierTest extends TestCase
{
    public function testSupplierReturnsCorrectPacks()
    {
        $packs = [
            new ProductPack('Dental Floss', 1, 9.00),
            new ProductPack('Dental Floss', 20, 160.00),
            new ProductPack('Ibuprofen', 10, 48.00),
        ];

        $supplier = new Supplier('Supplier A', $packs);

        $this->assertEquals('Supplier A', $supplier->getName());
        $this->assertCount(3, $supplier->getProductPacks());

        $flossPacks = $supplier->getProductPacksByName('Dental Floss');
        $this->assertCount(2, $flossPacks);

        $ibuprofenPacks = $supplier->getProductPacksByName('Ibuprofen');
        $this->assertCount(1, $ibuprofenPacks);
    }
}