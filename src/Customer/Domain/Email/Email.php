<?php


namespace App\Customer\Domain\Email;

final class Email
{
    const EMAIL_REGEX = "/^[^ @]+@[^ .]+\.[^ .]+$/";
    private string $address;

    /**
     * Email constructor.
     *
     * @param string $address
     *
     */
    private function __construct(string $address)
    {
        $this->address = $address;
    }

    /**
     * @param string $address
     *
     * @return Email
     * @throws EmailDomainException
     */
    public static function create(string $address): self
    {
        self::validate($address);

        return new self($address);
    }

    /**
     * @param string $adress
     *
     * @throws EmailDomainException
     */
    private static function validate(string $adress)
    {
        if ( ! preg_match(self::EMAIL_REGEX, $adress)) {
            EmailDomainException::badFormat($adress);
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->address;
    }

    /**
     * @param Email $email
     *
     * @return bool
     */
    public function equals(self $email): bool
    {
        return $email->address == $this->address;
    }

}