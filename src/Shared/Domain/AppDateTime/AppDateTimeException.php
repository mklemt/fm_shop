<?php


namespace App\Shared\Domain\AppDateTime;

use Exception;

class AppDateTimeException extends Exception
{

    public static function notValidDateFormatString()
    {
        $message = sprintf("Nieprawidłowy format daty");

        throw new self($message);
    }
}