<?php


namespace App\Product\Domain\ProductName;


class ProductName
{
    const MIN_LENGTH = 5;
    const MAX_LENGTH = 50;

    private string $productName;

    private function __construct(string $productName)
    {
        $this->assertLengthString($productName);

        $this->productName = $productName;
    }

    private function assertLengthString(string $productName): void
    {
        if (empty($productName)) {
            ProductNameDomainException::isEmpty();
        }
        if (strlen($productName) < self::MIN_LENGTH) {
            ProductNameDomainException::isTooShort($productName, self::MIN_LENGTH);
        }
        if (strlen($productName) > self::MAX_LENGTH) {
            ProductNameDomainException::isTooLong($productName, self::MAX_LENGTH);
        }
    }

    public static function setName(string $productName): self
    {
        return new self($productName);
    }

    public function equal(ProductName $name): bool
    {
        return $this->productName === $name->productName;
    }

    public function value(): string
    {
        return $this->productName;

    }

}