<?php


namespace App\Customer\Domain\Email;

use Exception;
use Throwable;

final class EmailDomainException extends Exception
{
    private function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function badFormat(string $adress)
    {
        $message = sprintf("Podana wartość: %s nie jest prawidłowym adresem e-mail", $adress);

        throw new self($message);
    }
}