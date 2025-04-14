<?php

declare(strict_types=1);

namespace Wawibox\Order;

/**
 * An Order is a list of OrderItems.
 */
class Order
{
    /**
     * @param OrderItem[] $items
     */
    public function __construct(
        private array $items
    ) {}

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}