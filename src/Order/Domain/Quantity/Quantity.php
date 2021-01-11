<?php


namespace App\Order\Domain\Quantity;

final class Quantity
{
    private int $quantity;

    private function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public static function add(int $quantity): self
    {
        self::toLittleAssert($quantity);

        return new self($quantity);
    }

    public static function onlyOne(int $quantity): self
    {
        self::toLittleAssert($quantity);
        self::onlyOneAssert($quantity);

        return new self($quantity);

    }

    private static function toLittleAssert(int $quantity)
    {
        if ($quantity <= 0) {
            QuantityDomainException::tooLittle();
        }
    }

    private static function onlyOneAssert(int $quantity)
    {
        if ($quantity > 1) {
            QuantityDomainException::canOnlyBeOne();
        }
    }

    public function total()
    {
        return $this->quantity;
    }
}