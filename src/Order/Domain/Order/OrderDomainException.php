<?php


namespace App\Order\Domain\Order;

use Exception;

class OrderDomainException extends Exception
{
    public static function quantityIsGraterThenOne()
    {
        $message = sprintf("Podana ilość jest większa niż jeden");

        throw new self($message);
    }

    public static function productIsUnavialable(string $productName)
    {
        $message = sprintf("Unikatowy produkt %s jest niedostępny, nie można dodać go do zamówienia", $productName);

        throw new self($message);
    }

    public static function customerIsTooYoungForProduct(string $productName)
    {
        $message = sprintf("Unikatowy produkt %s jest udostępniony do zakupu tylko przez dorosłych użytkowników", $productName);
        throw new self($message);
    }
}