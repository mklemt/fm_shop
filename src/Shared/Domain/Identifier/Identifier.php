<?php


namespace App\Shared\Domain\Identifier;

use Assert\Assertion;

final class Identifier
{
    private string $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     *
     * @return Identifier
     */
    public static function fromString(string $id): Identifier
    {
        self::validate($id);
        return new self($id);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->id;
    }

    /**
     * @param Identifier $identifier
     *
     * @return bool
     */
    public function equal(Identifier $identifier): bool
    {
        return $identifier->value() == $this->value();
    }

    private static function validate($id)
    {
        try {
            Assertion::uuid($id);
        } catch (\Throwable $exception) {
            throw IdentifierDomainException::badFormatOfUUID();
        }
    }

}