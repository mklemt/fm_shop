<?php


namespace App\Order\Application;

use App\Order\Domain\OrderEventInterface;

interface OrderEventListenerInterface
{
    public function handle(OrderEventInterface $event);

}