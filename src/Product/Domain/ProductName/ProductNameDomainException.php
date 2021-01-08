<?php


namespace App\Product\Domain\ProductName;

use Exception;
use Throwable;

final class ProductNameDomainException extends Exception
{
    private function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function isEmpty()
    {
        $message = sprintf("Podana nazwa jest pusta");

        throw new self($message);
    }

    public static function isTooShort(string $productName, int $minLength)
    {
        $message = sprintf("Podana nazwa %s jest zbyt krótka. Musi być większa niż %s", $productName, $minLength);

        throw new self($message);
    }

    public static function isTooLong(string $productName, int $maxLength)
    {
        $message = sprintf("Podana nazwa %s jest zbyt długa. Musi być mniejsza niż %s", $productName, $maxLength);

        throw new self($message);
    }

}