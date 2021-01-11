<?php


namespace App\Tests\Integration\Order\Domain;

use App\Customer\Domain\Customer\Customer;
use App\Order\Domain\Order\Order;
use App\Order\Domain\Order\OrderDomainException;
use App\Order\Domain\Quantity\Quantity;
use App\Product\Application\Event\UniqueProductWasOrderedListener;
use App\Product\Domain\Product\Product;
use App\Product\Domain\Product\UniqueProductWasOrdered;
use App\Product\Infrastructure\Repository\MockProductRepository;
use App\Tests\Unit\Order\Domain\OrderBase;

class OrderTest extends OrderBase
{
    private Customer $customer;
    /**
     * @var Product
     */
    private Product $product;
    /**
     * @var MockProductRepository
     */
    private MockProductRepository $productRepository;

    public function setUp()
    {
        parent::setUp();
        $this->customer          = Customer::create($this->customerId, $this->customerName, $this->email, $this->birthDate);
        $this->product           = Product::create($this->productId, $this->productName);
        $this->productRepository = new MockProductRepository($this->product);
    }

    public function testICanCreateOrderForUniqueProduct()
    {
        $order    = new Order($this->customerId);
        $quantity = Quantity::unique(1);
        $order->addLineForUniqeProduct($this->product, $quantity);

        $listener = new UniqueProductWasOrderedListener($this->productRepository);

        foreach ($order->releaseEvents() as $event) {
            if ($event instanceof UniqueProductWasOrdered) {
                $listener->handle($event);
            }
        }
        $this->assertFalse($this->productRepository->getById($this->product->productId())->isAvailable());
    }

    public function testICanCreateOrderFor2SameUniqueProducts()
    {
        $order    = new Order($this->customerId);
        $quantity = Quantity::unique(1);
        $order->addLineForUniqeProduct($this->product, $quantity);

        $listener = new UniqueProductWasOrderedListener($this->productRepository);

        foreach ($order->releaseEvents() as $event) {
            if ($event instanceof UniqueProductWasOrdered) {
                $listener->handle($event);
            }
        }
        $this->expectException(OrderDomainException::class);
        $order->addLineForUniqeProduct($this->product, $quantity);
    }
}