<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Wawibox\Order\Order;
use Wawibox\PriceCalculator\PriceCalculator;
use Wawibox\Service\SupplierComparisonService;
use Wawibox\Supplier\SupplierCatalog;
use Wawibox\Validations\ValidateOrder;

$validateOrder = new ValidateOrder();
$supplierCatalog = new SupplierCatalog();

try {
    $orderItems = $validateOrder->validateOrderItems();
    $order = new Order($orderItems);
    $service = new SupplierComparisonService($supplierCatalog->getSupplierCatalog(), new PriceCalculator());
    $result = $service->findBestSupplier($order);

    echo "Best Supplier: " . $result['supplier']->getName() . PHP_EOL;
    echo "Total Price: " . number_format($result['price'], 2) . " EUR" . PHP_EOL;
} catch (RuntimeException | InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
    exit(1);
}