<?php


namespace App\Shared\Domain\DateTime;

use Exception;

class DateTimeException extends Exception
{

    public static function notValidDateFormatString()
    {
        $message = sprintf("Nieprawidłowy format daty");

        throw new self($message);
    }
}