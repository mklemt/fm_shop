<?php


namespace App\Product\Domain\Product;

use App\Product\Domain\ProductName\ProductName;
use App\Shared\Domain\Identifier\Identifier;

final class Product
{
    /**
     * @var Identifier
     */
    private Identifier $identifier;
    /**
     * @var ProductName
     */
    private ProductName $productName;

    private bool $isAvailable;

    private array $events = [];

    private function __construct(Identifier $identifier, ProductName $productName)
    {
        $this->identifier  = $identifier;
        $this->productName = $productName;
    }

    public static function create(Identifier $identifier, ProductName $productName): self
    {
        $product = new self($identifier, $productName);
        $product->available();

        return $product;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function available(): void
    {
        $this->isAvailable = true;
    }

    public function unAvailable(): void
    {
        $this->isAvailable = false;
    }

    public function releaseEvents(): array
    {
        return $this->events;
    }

    public function productId(): string
    {
        return $this->identifier->value();

    }

}