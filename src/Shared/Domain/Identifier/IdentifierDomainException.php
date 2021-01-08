<?php


namespace App\Shared\Domain\Identifier;

use Exception;
use Throwable;

final class IdentifierDomainException extends Exception
{
    private function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @throws IdentifierDomainException
     */
    public static function badFormatOfUUID()
    {
        $message = sprintf("Nieprawidłowy format podanego identyfikatora");

        throw new self($message);
    }

}