<?php


namespace App\Customer\Domain\Customer;


use App\Customer\Domain\CustomerName\CustomerName;
use App\Customer\Domain\Email\Email;
use App\Shared\Domain\DateTime\DateTime;
use App\Shared\Domain\Identifier\Identifier;

class Customer
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
     * @var DateTime
     */
    private DateTime $dateOfBirth;

    public function __construct(Identifier $identifier, CustomerName $customerName, Email $email, DateTime $dateOfBirth)
    {
        $this->identifier   = $identifier;
        $this->customerName = $customerName;
        $this->email        = $email;
        $this->dateOfBirth  = $dateOfBirth;
    }

    public function isAdult(): bool
    {
        return DateTime::checkAdultAge($this->dateOfBirth);
    }

}