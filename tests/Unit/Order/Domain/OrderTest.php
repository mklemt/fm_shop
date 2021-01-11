<?php


namespace App\Tests\Unit\Order\Domain;

use App\Customer\Domain\Customer\Customer;
use App\Order\Domain\Order\Order;
use App\Order\Domain\Order\OrderDomainException;
use App\Order\Domain\Quantity\Quantity;
use App\Order\Domain\Quantity\QuantityDomainException;
use App\Product\Domain\Product\Product;

class OrderTest extends OrderBase
{
    /**
     * @var Product
     */
    private Product $product;
    /**
     * @var Customer
     */
    private Customer $customer;

    public function setUp()
    {
        parent::setUp();
        $this->product  = Product::create($this->productId, $this->productName);
        $this->customer = Customer::create($this->customerId, $this->customerName, $this->email, $this->birthDate);
    }

    public function testICanCreateOrderForProduct()
    {
        $order    = Order::create($this->orderId, $this->customerId);
        $quantity = Quantity::unique(1);
        $order->addLineForUniqeProduct($this->product, $quantity);
        $this->assertNotEmpty($order->getLines());

    }

    public function testICanCreateOrderForNonAvalilableProduct()
    {
        $this->expectException(OrderDomainException::class);
        $order    = Order::create($this->orderId, $this->customerId);
        $quantity = Quantity::unique(1);
        $this->product->unAvailable();
        $order->addLineForUniqeProduct($this->product, $quantity);

    }

    public function testICanOrderMoreThenOneProduct()
    {
        $this->expectException(QuantityDomainException::class);
        $order    = Order::create($this->orderId, $this->customerId);
        $quantity = Quantity::unique(2);
        $order->addLineForUniqeProduct($this->product, $quantity);

    }

    public function testICanOrderMoreThenOneProductByAdd()
    {
        $this->expectException(OrderDomainException::class);
        $order    = Order::create($this->orderId, $this->customerId);
        $quantity = Quantity::add(2);
        $order->addLineForUniqeProduct($this->product, $quantity);

    }
}