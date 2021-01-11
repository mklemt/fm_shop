<?php


namespace App\Order\Application\Event;

use App\Order\Domain\Order\UniqueProductWasOrdered;
use App\Product\Domain\ProductRepositoryInterface;

class UniqueProductWasOrderedListener
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(UniqueProductWasOrdered $event)
    {
        $product = $this->productRepository->getById($event->getProductId());
        if (is_null($product)) {
            return;
        }
        $product->unAvailable();
        $this->productRepository->save($product);

    }

}