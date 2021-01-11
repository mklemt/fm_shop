<?php


namespace App\Tests\Unit\Order\Domain;

use App\Customer\Domain\Customer\Customer;
use App\Order\Domain\Order\Order;
use App\Order\Domain\Order\OrderDomainException;
use App\Order\Domain\Quantity\Quantity;
use App\Order\Domain\Quantity\QuantityDomainException;
use App\Product\Domain\Product\Product;
use App\Shared\Domain\AppDateTime\AppDateTime;

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
        $quantity = Quantity::onlyOne(1);
        $order->addLineForUniqeProductForAdults($this->product, $quantity, $this->customer);
        $this->assertNotEmpty($order->getLines());

    }

    public function testICanCreateOrderForProductForChild()
    {
        $this->expectException(OrderDomainException::class);
        $childBirthDate = AppDateTime::createFromFormat("2010-01-01", "Y-m-d");
        $customer       = Customer::create($this->customerId, $this->customerName, $this->email, $childBirthDate);
        $order          = Order::create($this->orderId, $customer->customerId());
        $quantity       = Quantity::onlyOne(1);
        $order->addLineForUniqeProductForAdults($this->product, $quantity, $customer);
    }

    public function testICanCreateOrderForNonAvalilableProduct()
    {
        $this->expectException(OrderDomainException::class);
        $order    = Order::create($this->orderId, $this->customerId);
        $quantity = Quantity::onlyOne(1);
        $this->product->unAvailable();
        $order->addLineForUniqeProductForAdults($this->product, $quantity, $this->customer);

    }

    public function testIfQuantityOfProductsCanBeGreterThenOne()
    {
        $this->expectException(QuantityDomainException::class);
        $order    = Order::create($this->orderId, $this->customerId);
        $quantity = Quantity::onlyOne(2);
        $order->addLineForUniqeProductForAdults($this->product, $quantity, $this->customer);

    }

    public function testICanOrderMoreThenOneProduct()
    {
        $this->expectException(OrderDomainException::class);
        $order    = Order::create($this->orderId, $this->customerId);
        $quantity = Quantity::add(2);
        $order->addLineForUniqeProductForAdults($this->product, $quantity, $this->customer);

    }
}