<?php


namespace App\Product\Domain;


use App\Product\Domain\Product\Product;

interface ProductRepositoryInterface
{
    public function getById(string $uuid): ?Product;

    public function save(Product $product);

}