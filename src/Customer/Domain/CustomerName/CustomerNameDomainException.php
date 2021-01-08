<?php


namespace App\Customer\Domain\CustomerName;

use Exception;
use Throwable;

class CustomerNameDomainException extends Exception
{
    private function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function badFormat(string $name)
    {
        $message = sprintf("Podana nazwa użytkownika %s zawiera niedozwolone znaki", $name);

        throw new self($message);
    }
}