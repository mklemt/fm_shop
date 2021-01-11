<?php


namespace App\Order\Domain\Order;

use App\Order\Domain\OrderEventInterface;

class UniqueProductWasOrdered implements OrderEventInterface
{
    private string $productId;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }


}