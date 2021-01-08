<?php


namespace App\Order\Domain\Order;


use App\Shared\Domain\Identifier\Identifier;

class Order
{
    private function __construct(Identifier $orderId, string $orderNumber, string $customerId, string $description, int $total)
    {
    }

}