<?php


namespace App\Order\Domain\Order;

use App\Order\Domain\Quantity\Quantity;
use App\Product\Domain\Product\Product;
use App\Product\Domain\Product\UniqueProductWasOrdered;
use App\Shared\Domain\Identifier\Identifier;

final class Order
{
    private Identifier $customerId;
    private array $lines = [];
    private array $events = [];
    /**
     * @var Identifier
     */
    private Identifier $orderId;

    private function __construct(Identifier $orderId, Identifier $customerId)
    {
        $this->customerId = $customerId;
        $this->orderId    = $orderId;
    }

    public static function create(string $orderId, string $customerId): self
    {
        $customerUuid = Identifier::fromString($customerId);
        $orderUuid    = Identifier::fromString($orderId);

        return new self($orderUuid, $customerUuid);
    }


    public function addLineForUniqeProduct(Product $product, Quantity $quantity)
    {
        if ($quantity->total() > 1) {
            OrderDomainException::quantityIsGraterThenOne();
        }
        if ( ! $product->isAvailable()) {
            OrderDomainException::productIsUnavialable($product->name()->value());
        }
        $this->lines[]  = new OrderLine($product->productId(), $quantity);
        $this->events[] = new UniqueProductWasOrdered($product->productId());
    }

    public function releaseEvents(): array
    {
        return $this->events;
    }

    /**
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    public function orderId()
    {
        return $this->orderId->value();

    }


}