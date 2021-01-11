<?php


namespace App\Tests\Integration\Order\Domain;

use App\Customer\Domain\Customer\Customer;
use App\Order\Application\Event\UniqueProductWasOrderedListener;
use App\Order\Domain\Order\Order;
use App\Order\Domain\Order\OrderDomainException;
use App\Order\Domain\Order\UniqueProductWasOrdered;
use App\Order\Domain\Quantity\Quantity;
use App\Product\Domain\Product\Product;
use App\Product\Infrastructure\Repository\MockProductRepository;
use App\Tests\Unit\Order\Domain\OrderBase;

class OrderTest extends OrderBase
{
    private Customer $customer;
    private Product $product;
    private MockProductRepository $productRepository;
    private Order $order;
    private Quantity $quantity;

    public function setUp()
    {
        parent::setUp();
        $this->customer          = Customer::create($this->customerId, $this->customerName, $this->email, $this->birthDate);
        $this->product           = Product::create($this->productId, $this->productName);
        $this->productRepository = new MockProductRepository($this->product);
        $this->order             = Order::create($this->orderId, $this->customerId);
        $this->quantity          = Quantity::unique(1);
    }

    public function testICanCreateOrderForUniqueProduct()
    {
        $this->order->addLineForUniqeProduct($this->product, $this->quantity);

        $this->dispatchListener();
        $this->assertFalse($this->productRepository->getById($this->product->productId())->isAvailable());
    }

    public function testICanCreateOrderFor2SameUniqueProducts()
    {
        $this->order->addLineForUniqeProduct($this->product, $this->quantity);

        $this->dispatchListener();
        $this->expectException(OrderDomainException::class);
        $this->order->addLineForUniqeProduct($this->product, $this->quantity);
    }

    private function dispatchListener(): void
    {
        $listener = new UniqueProductWasOrderedListener($this->productRepository);

        foreach ($this->order->releaseEvents() as $event) {
            if ($event instanceof UniqueProductWasOrdered) {
                $listener->handle($event);
            }
        }
    }
}