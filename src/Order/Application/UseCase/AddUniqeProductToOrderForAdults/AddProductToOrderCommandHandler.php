<?php


namespace App\Order\Application\UseCase\AddUniqeProductToOrderForAdults;

use App\Customer\Domain\CustomerRepositoryInterface;
use App\Order\Domain\OrderRepositoryInterface;
use App\Product\Domain\ProductRepositoryInterface;
use App\Shared\Application\CommandBus\CommandHandlerInterface;

final class AddProductToOrderCommandHandler implements CommandHandlerInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;
    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository, ProductRepositoryInterface $productRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->productRepository  = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(AddProductToOrderCommand $command)
    {
        // TODO: pobierz uzytkownika z repozytorium
        // TODO: sprawdź czy jest dorossly customer->isAdult()
        // TODO: utwórz Zamówienie (Order)
        // TODO: pobierz product z repozytorium
        // TODO: sprawdź czy jest dostępny product->isAvailable()
        // TODO: utwórz quantitty = Quantity::unique(ilość)
        // TODO: dodaj do zamówienia Order->addLine(Identtifier::fromString(prduct->getId()), quantitty)

        // TODO: zmień dostępność produktu product->unavailable()
        // TODO: zapisz product do repozytorium productRepository->save(product)
        // TODO: albo wykorzystaj listenera nasłuchującego eventu UniqueProductWasOrdered i w nim zmień dostępność produktu
    }

}