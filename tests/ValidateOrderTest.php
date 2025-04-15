<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Wawibox\Validations\ValidateOrder;

class ValidateOrderTest extends TestCase
{
    public function testValidInputSingleItem(): void
    {
        global $argv, $argc;
        $argv = ['index.php', 'Ibuprofen:10'];
        $argc = count($argv);

        $validator = new ValidateOrder();
        $result = $validator->validateOrderItems();

        $this->assertCount(1, $result);
        $this->assertEquals('Ibuprofen', $result[0]->getProductName());
        $this->assertEquals(10, $result[0]->getQuantity());
    }

    public function testValidInputMultipleItems(): void
    {
        global $argv, $argc;
        $argv = ['index.php', 'Ibuprofen:10,Dental Floss:5'];
        $argc = count($argv);

        $validator = new ValidateOrder();
        $result = $validator->validateOrderItems();

        $this->assertCount(2, $result);
    }

    public function testMissingCLIArgument(): void
    {
        global $argv, $argc;
        $argv = ['index.php'];
        $argc = count($argv);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Usage: Please enter valid arguments');

        $validator = new ValidateOrder();
        $validator->validateOrderItems();
    }

    public function testInvalidFormatMissingColon(): void
    {
        global $argv, $argc;
        $argv = ['index.php', 'Ibuprofen-10'];
        $argc = count($argv);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid format. Use: Product:Quantity');

        $validator = new ValidateOrder();
        $validator->validateOrderItems();
    }

    public function testInvalidProductName(): void
    {
        global $argv, $argc;
        $argv = ['index.php', 'InvalidProduct:5'];
        $argc = count($argv);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid product');

        $validator = new ValidateOrder();
        $validator->validateOrderItems();
    }

    public function testInvalidNegativeQuantity(): void
    {
        global $argv, $argc;
        $argv = ['index.php', 'Ibuprofen:0'];
        $argc = count($argv);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid quantity');

        $validator = new ValidateOrder();
        $validator->validateOrderItems();
    }
}