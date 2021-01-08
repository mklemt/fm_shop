<?php


namespace App\Product\Domain\Product;


use App\Product\Domain\ProductName\ProductName;
use App\Shared\Domain\Identifier\Identifier;

class Product
{
    /**
     * @var Identifier
     */
    private Identifier $identifier;
    /**
     * @var ProductName
     */
    private ProductName $productName;

    private array $events = [];
    private bool $forAdultsOnly;

    private function __construct(Identifier $identifier, ProductName $productName, bool $forAdultsOnly)
    {
        $this->identifier = $identifier;
        $this->productName = $productName;
        $this->forAdultsOnly = $forAdultsOnly;
    }

}