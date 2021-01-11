<?php


namespace App\Order\Domain;

use App\Order\Domain\Order\Order;

interface OrderRepositoryInterface
{
    public function getById(string $uuid): ?Order;

    public function save(Order $product);

}