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
}