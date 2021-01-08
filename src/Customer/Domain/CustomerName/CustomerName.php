<?php


namespace App\Customer\Domain\CustomerName;


class CustomerName
{
    const FORMAT = "^([a-zA-Z]{2,}\s[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)";
    private string $name;

    private function __construct(string $name)
    {
        $this->assertValidFormat($name);
        $this->name = $name;
    }


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


    public static function setName(string $username): self
    {
        return new self($username);
    }

    private function assertValidFormat(string $name)
    {
        if (preg_match(self::FORMAT, $name) !== 1) {
            CustomerNameDomainException::badFormat($name);
        }
    }

}