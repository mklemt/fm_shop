<?php


namespace App\Tests\Unit\Shared\Domain;

use App\Shared\Domain\Identifier\IdentifierDomainException;
use PHPUnit\Framework\TestCase;
use App\Shared\Domain\Identifier\Identifier;

class IdentifierTest extends TestCase
{
    private $uuid = "885d01a7-1352-4f70-a996-abb8dc003dd2";
    private $validId;

    public function setUp()
    {
        $this->validId = Identifier::fromString($this->uuid);
    }

    /**
     * @dataProvider additionProvider
     */
    public function testAssert(string $username): void
    {
        $this->expectException(IdentifierDomainException::class);
        Identifier::fromString($username);
    }

    /**
     * @dataProvider validProviders
     */
    public function testValid(string $guid): void
    {
        $generatedGuid = Identifier::fromString($guid);
        $this->assertSame($generatedGuid->asString(), $guid);
    }

    public function additionProvider(): array
    {
        return [
            [""],
            ["Ala"],
            ["M#ariusz"],
            ["M riusz"],
        ];
    }

    public function validProviders()
    {
        return [
            ["885d01a7-1352-4f70-a996-abb8dc003dd2"],
            ["885d01a7-1352-dddd-a996-abb8dc003dd2"],
        ];

    }
}