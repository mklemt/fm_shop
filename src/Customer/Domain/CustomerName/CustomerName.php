<?php


namespace App\Customer\Domain\CustomerName;

final class CustomerName
{
    const MIN_LENGTH = 5;
    const MAX_LENGTH = 30;
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
        self::assertValidLength($username);

        return new self($username);
    }

    /**
     * @param string $name
     *
     * @throws CustomerNameDomainException
     */
    private static function assertValidLength(string $name)
    {
        if (empty($name)) {
            CustomerNameDomainException::isEmpty();
        }
        if (strlen($name) < self::MIN_LENGTH) {
            CustomerNameDomainException::isTooShort($name, self::MIN_LENGTH);
        }
        if (strlen($name) > self::MAX_LENGTH) {
            CustomerNameDomainException::isTooLong($name, self::MAX_LENGTH);
        }

    }

}