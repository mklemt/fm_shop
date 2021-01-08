<?php


namespace App\Customer\Domain\Email;


class Email
{
    const EMAIL_REGEX = "/^[^ @]+@[^ .]+\.[^ .]+$/";
    private string $address;

    /**
     * Email constructor.
     *
     * @param string $address
     *
     * @throws EmailDomainException
     */
    private function __construct(string $address)
    {
        $this->validate($address);

        $this->address = $address;

    }

    /**
     * @param string $adress
     *
     * @return Email
     * @throws EmailDomainException
     */
    public static function setAddress(string $adress): self
    {
        return new self($adress);
    }

    /**
     * @param string $adress
     *
     * @throws EmailDomainException
     */
    private function validate(string $adress)
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