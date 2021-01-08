<?php


namespace App\Order\Application\UseCase\AddUniqeProductToOrderForAdults;

use App\Shared\Application\CommandBus\CommandInterface;

final class AddProductToOrderCommand implements CommandInterface
{
    private string $productId;
    private int $quantity;
    private string $customerId;

    public function __construct(string $customerId, string $productId, int $quantity)
    {
        $this->productId  = $productId;
        $this->quantity   = $quantity;
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }



}