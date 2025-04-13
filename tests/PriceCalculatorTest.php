<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Wawibox\Order\Order;
use Wawibox\Order\OrderItem;
use Wawibox\Product\ProductPack;
use Wawibox\Supplier\Supplier;
use Wawibox\PriceCalculator\PriceCalculator;

class PriceCalculatorTest extends TestCase
{
    public function testPriceCalculationExample1()
    {
        $supplier = new Supplier('Supplier B', [
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

        $calculator = new PriceCalculator();
        $total = $calculator->calculateTotalPrice($order, $supplier);

        $this->assertEquals(102.00, $total);
    }
}