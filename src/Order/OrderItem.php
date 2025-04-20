<?php

declare(strict_types=1);

namespace Wawibox\Order;

/**
 * Each OrderItem represents one product
 */
class OrderItem
{
    public const DENTAL_FLOSS = 'Dental Floss';
    public const IBUROFEN = 'Ibuprofen';

    public static array $orderItems =
    [
        self::DENTAL_FLOSS,
        self::IBUROFEN
    ];

    public function __construct(
        private string $productName,
        private int $quantity
    ) {
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
