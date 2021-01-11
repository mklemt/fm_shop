<?php


namespace App\Customer\Domain\Customer;

use App\Customer\Domain\CustomerName\CustomerName;
use App\Customer\Domain\Email\Email;
use App\Shared\Domain\AppDateTime\AppDateTime;
use App\Shared\Domain\Identifier\Identifier;

final class Customer
{
    /**
     * @var Identifier
     */
    private Identifier $identifier;
    /**
     * @var CustomerName
     */
    private CustomerName $customerName;
    /**
     * @var Email
     */
    private Email $email;
    /**
     * @var AppDateTime
     */
    private AppDateTime $dateOfBirth;

    private array $events = [];

    private function __construct(Identifier $identifier, CustomerName $customerName, Email $email, AppDateTime $dateOfBirth)
    {
        $this->identifier   = $identifier;
        $this->customerName = $customerName;
        $this->email        = $email;
        $this->dateOfBirth  = $dateOfBirth;
    }

    public function isAdult(): bool
    {
        return AppDateTime::checkAdultAge($this->dateOfBirth);
    }

    public static function create(Identifier $identifier, CustomerName $customerName, Email $email, AppDateTime $dateOfBirth): self
    {
        return new self($identifier, $customerName, $email, $dateOfBirth);
    }

    public function releaseEvents(): array
    {
        return $this->events;
    }

    public function customerId(): string
    {
        return $this->identifier->value();
    }
}