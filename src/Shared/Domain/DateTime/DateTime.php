<?php


namespace App\Shared\Domain\DateTime;


use DateTimeImmutable;

class DateTime
{
    const ADULT_AGE = 18;
    private DateTimeImmutable $dateTimeImmutable;

    private function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        $this->dateTimeImmutable = $dateTimeImmutable;
    }

    public static function now(): self
    {
        $dateTimeImmutable = new DateTimeImmutable();

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

    public function equal(DateTime $dateTime)
    {

    }

    public static function create(DateTimeImmutable $dateTime): self
    {
        return new DateTime($dateTime);
    }
}