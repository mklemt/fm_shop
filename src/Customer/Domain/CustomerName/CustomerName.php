<?php


namespace App\Customer\Domain\CustomerName;

final class CustomerName
{
    const FORMAT = "^([a-zA-Z]{2,}\s[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)";
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param CustomerName $customerName
     *
     * @return bool
     */
    public function equal(CustomerName $customerName): bool
    {
        return $this->name === $customerName->name;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name;
    }

    /**
     * @param string $username
     *
     * @return static
     * @throws CustomerNameDomainException
     */
    public static function create(string $username): self
    {
        self::assertValidFormat($username);

        return new self($username);
    }

    /**
     * @param string $name
     *
     * @throws CustomerNameDomainException
     */
    private static function assertValidFormat(string $name)
    {
        if (preg_match(self::FORMAT, $name) !== 1) {
            CustomerNameDomainException::badFormat($name);
        }
    }

}