<?php


namespace App\Product\Infrastructure\Repository;

use App\Product\Domain\Product\Product;
use App\Product\Domain\ProductRepositoryInterface;

class MockProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    private array $products = [];

    public function __construct(Product $product)
    {
        $this->products[$product->productId()] = $product;
    }

    public function getById(string $uuid): ?Product
    {
        if (array_key_exists($uuid, $this->products)) {
            return $this->products[$uuid];
        }

        return null;
    }

    public function save(Product $product)
    {
        $this->products[$product->productId()] = $product;

        return true;
    }
}