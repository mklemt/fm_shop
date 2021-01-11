<?php


namespace App\Order\Domain\Order;

use App\Order\Domain\Quantity\Quantity;
use App\Shared\Domain\Identifier\Identifier;

final class OrderLine
{
    private string $productId;
    /**
     * @var Quantity
     */
    private Quantity $quantity;

    public function __construct(string $productId, Quantity $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

}