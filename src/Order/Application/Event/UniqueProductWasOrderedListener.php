<?php


namespace App\Order\Application\Event;

use App\Order\Application\OrderEventListenerInterface;
use App\Order\Domain\Order\UniqueProductWasOrdered;
use App\Order\Domain\OrderEventInterface;
use App\Product\Domain\ProductRepositoryInterface;

class UniqueProductWasOrderedListener implements OrderEventListenerInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle($event)
    {
        if ( ! $event instanceof OrderEventInterface) {
            return;
        }
        if ( ! $event instanceof UniqueProductWasOrdered) {
            return;
        }
        $product = $this->productRepository->getById($event->getProductId());
        if (is_null($product)) {
            return;
        }
        $product->unAvailable();
        $this->productRepository->save($product);

    }

}