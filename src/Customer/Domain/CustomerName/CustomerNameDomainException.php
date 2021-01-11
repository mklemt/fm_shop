<?php


namespace App\Customer\Domain\CustomerName;

use Exception;
use Throwable;

final class CustomerNameDomainException extends Exception
{
    /**
     * CustomerNameDomainException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    private function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $name
     *
     * @throws CustomerNameDomainException
     */
    public static function badFormat(string $name)
    {
        $message = sprintf("Podana nazwa użytkownika %s zawiera niedozwolone znaki", $name);

        throw new self($message);
    }

    public static function isTooShort(string $username, int $minLength)
    {
        $message = sprintf("Podana nazwa użytkownika %s jest zbyt krótka. Musi być większa niż %s", $username, $minLength);

        throw new self($message);
    }

    public static function isTooLong(string $username, int $maxLength)
    {
        $message = sprintf("Podana nazwa użytkownika %s jest zbyt długa. Musi być mniejsza niż %s", $username, $maxLength);

        throw new self($message);
    }

    public static function isEmpty()
    {
        $message = sprintf("Podana nazwa użytkownika jest pusta");

        throw new self($message);
    }
}