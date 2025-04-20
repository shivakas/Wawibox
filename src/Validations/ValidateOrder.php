<?php

declare(strict_types=1);

namespace Wawibox\Validations;

use Wawibox\Order\OrderItem;

class ValidateOrder
{
    /**
     * @throws \InvalidArgumentException
     * @return OrderItem[]
     */
    public function validateOrderItems(): array
    {
        global $argv;
        global $argc;

        if ($argc < 2) {
            throw new \InvalidArgumentException('Usage: Please enter valid arguments in format "Product1:Quantity1,Product2:Quantity2"');
        }

        $input = $argv[1];
        $orderItems = [];

        foreach (explode(',', $input) as $item) {
            $parts = explode(':', $item);

            if (count($parts) !== 2) {
                throw new \InvalidArgumentException('Invalid format. Use: Product:Quantity');
            }

            $productName = trim($parts[0]);
            $quantity = (int) trim($parts[1]);

            if (in_array($productName, OrderItem::$orderItems) === false) {
                //throw new \InvalidArgumentException("Invalid product: '$productName'". "Available products:'OrderItem::$orderItems'");
                throw new \InvalidArgumentException(
                    sprintf(
                        "Invalid product: %s. Available products: %s.",
                        $productName,
                        implode(",", OrderItem::$orderItems)
                    )
                );
            }

            if ($quantity <= 0) {
                throw new \InvalidArgumentException(
                    sprintf("Invalid quantity for product %s.", $productName)
                );
            }

            $orderItems[] = new OrderItem($productName, $quantity);
        }

        return $orderItems;
    }
}
