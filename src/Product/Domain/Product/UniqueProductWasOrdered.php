<?php


namespace App\Product\Domain\Product;


class UniqueProductWasOrdered
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