<?php


namespace App\Shared\Domain\DateTime;


use DateTimeImmutable;

final class DateTime
{
    const ADULT_AGE = 18;
    private DateTimeImmutable $dateTimeImmutable;

    /**
     * DateTime constructor.
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

        return new DateTime($dateTimeImmutable);
    }

    public static function checkAdultAge(DateTime $dateOfBirth): bool
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
            DateTimeException::notValidDateFormatString();
        }

        return new DateTime($dateTime);
    }

    public static function createFromFormat(DateTimeImmutable $date, $format = 'Y-m-d'): self
    {
        if ( ! self::validateDate($date, $format)) {
            DateTimeException::notValidDateFormatString();
        }
        $dateTime = DateTimeImmutable::createFromFormat($format, $date);

        return new DateTime($dateTime);
    }

    public static function validateDate(DateTimeImmutable $date, $format = 'Y-m-d'): bool
    {
        $toValidate = DateTimeImmutable::createFromFormat($format, $date);

        return $toValidate && $toValidate->format($format) === $date;

    }

}