<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Wawibox\Order\Order;
use Wawibox\Order\OrderItem;

class OrderTest extends TestCase
{
    public function testOrderContainsItems()
    {
        $item1 = new OrderItem('Ibuprofen', 12);
        $item2 = new OrderItem('Dental Floss', 5);

        $order = new Order([$item1, $item2]);

        $this->assertCount(2, $order->getItems());
        $this->assertEquals('Ibuprofen', $order->getItems()[0]->getProductName());
        $this->assertEquals(5, $order->getItems()[1]->getQuantity());
    }
}