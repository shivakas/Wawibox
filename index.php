<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Wawibox\Product\ProductPack;
use Wawibox\Order\Order;
use Wawibox\Order\OrderItem;
use Wawibox\Supplier\Supplier;
use Wawibox\PriceCalculator\PriceCalculator;
use Wawibox\Service\SupplierComparisonService;

// Parse input
if ($argc < 2) {
    echo "Usage: php index.php \"Product1:Quantity1,Product2:Quantity2\"\n";
    exit(1);
}

$input = $argv[1];
$orderItems = [];

foreach (explode(',', $input) as $item) {
    $parts = explode(':', $item);
    if (count($parts) !== 2) {
        echo "Invalid format. Use: Product:Quantity\n";
        exit(1);
    }

    $productName = trim($parts[0]);
    $quantity = (int) trim($parts[1]);

    if ($quantity <= 0) {
        echo "Invalid quantity for product '$productName'\n";
        exit(1);
    }

    $orderItems[] = new OrderItem($productName, $quantity);
}

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

$order = new Order($orderItems);

try {
    $service = new SupplierComparisonService([$supplierA, $supplierB], new PriceCalculator());
    $result = $service->findBestSupplier($order);

    echo "Best Supplier: " . $result['supplier']->getName() . PHP_EOL;
    echo "Total Price: " . number_format($result['price'], 2) . " EUR" . PHP_EOL;
} catch (RuntimeException $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}