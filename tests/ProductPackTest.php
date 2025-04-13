<?php

declare(strict_types= 1);

use PHPUnit\Framework\TestCase;
use Wawibox\Product\ProductPack;

class ProductPackTest extends TestCase
{
    public function testProductPackProperties()
    {
        $productName = 'Dental Floss';
        $unitCount = 20;
        $price = 160.00;

        $pack = new ProductPack($productName, $unitCount, $price);

        $this->assertEquals($productName, $pack->getProductName());
        $this->assertEquals($unitCount, $pack->getUnitCount());
        $this->assertEquals($price, $pack->getPrice());
    }
}