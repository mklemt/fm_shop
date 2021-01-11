<?php


namespace App\Shared\Domain\AppDateTime;


use DateTimeImmutable;

final class AppDateTime
{
    const ADULT_AGE = 18;
    private DateTimeImmutable $dateTimeImmutable;

    /**
     * AppDateTime constructor.
     *
     * @param DateTimeImmutable $dateTimeImmutable
     */
    private function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        $this->dateTimeImmutable = $dateTimeImmutable;
    }

    /**
     * @return static
     */
    public static function now(): self
    {
        $dateTimeImmutable = new DateTimeImmutable('now');

        return new AppDateTime($dateTimeImmutable);
    }

    public static function checkAdultAge(AppDateTime $dateOfBirth): bool
    {
        $today    = new DateTimeImmutable(date("Y-m-d"));
        $interval = $today->diff($dateOfBirth->value());
        if (intval($interval->y) > self::ADULT_AGE) {
            return true;
        }

        return false;
    }

    public function value()
    {
        return $this->dateTimeImmutable;
    }

    public static function create(DateTimeImmutable $dateTime): self
    {
        if ( ! self::validateDate($dateTime)) {
            AppDateTimeException::notValidDateFormatString();
        }

        return new AppDateTime($dateTime);
    }

    public static function createFromFormat(string $dateString, $format = 'Y-m-d'): self
    {
        if ( ! self::validateDate($dateString, $format)) {
            AppDateTimeException::notValidDateFormatString();
        }
        $dateTime = DateTimeImmutable::createFromFormat($format, $dateString);

        return new AppDateTime($dateTime);
    }

    public static function validateDate(string $dateString, $format = 'Y-m-d'): bool
    {
        $toValidate = DateTimeImmutable::createFromFormat($format, $dateString);

        return $toValidate && $toValidate->format($format) === $dateString;
    }

}