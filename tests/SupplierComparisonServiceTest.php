<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Wawibox\Order\Order;
use Wawibox\Order\OrderItem;
use Wawibox\Product\ProductPack;
use Wawibox\Supplier\Supplier;
use Wawibox\PriceCalculator\PriceCalculator;
use Wawibox\Service\SupplierComparisonService;

class SupplierComparisonServiceTest extends TestCase
{
    public function testFindsCheapestSupplier()
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

        $order = new Order([
            new OrderItem('Dental Floss', 5),
            new OrderItem('Ibuprofen', 12),
        ]);

        $service = new SupplierComparisonService([$supplierA, $supplierB], new PriceCalculator());

        $result = $service->findBestSupplier($order);

        $this->assertEquals('Supplier B', $result['supplier']->getName());
        $this->assertEquals(102.00, $result['price']);
    }
}