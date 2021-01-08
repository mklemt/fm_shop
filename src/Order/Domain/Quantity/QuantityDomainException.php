<?php


namespace App\Order\Domain\Quantity;

use Exception;

class QuantityDomainException extends Exception
{

    public static function tooLittle()
    {
        $message = sprintf("Ilość produktów w zamówieniu musi wynosić co najmniej 1");

        throw new self($message);
    }

    public static function canOnlyBeOne()
    {
        $message = sprintf("Ilość produktów w zamówieniu nie może być większa niż jeden");

        throw new self($message);
    }
}