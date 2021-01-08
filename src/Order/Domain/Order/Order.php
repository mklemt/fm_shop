<?php


namespace App\Order\Domain\Order;

use App\Order\Domain\Quantity\Quantity;
use App\Shared\Domain\Identifier\Identifier;

final class Order
{
    private string $customerId;
    private array $lines;
    private array $events = [];

    private function __construct(Identifier $customerId)
    {
        $this->customerId = $customerId;
    }

    public function addLine(Identifier $productId, Quantity $quantity)
    {
        $this->lines[] = new OrderLine($productId, $quantity);
    }

    public function releaseEvents(): array
    {
        return $this->events;
    }

}