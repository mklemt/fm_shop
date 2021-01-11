<?php


namespace App\Tests\Integration\Order\Domain;

use App\Customer\Domain\CustomerName\CustomerName;
use App\Customer\Domain\Email\Email;
use App\Product\Domain\ProductName\ProductName;
use App\Shared\Domain\AppDateTime\AppDateTime;
use App\Shared\Domain\Identifier\Identifier;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class OrderBase extends TestCase
{
    /**
     * @var AppDateTime
     */
    protected AppDateTime $birthDate;
    /**
     * @var Identifier
     */
    protected Identifier $customerId;
    /**
     * @var Identifier
     */
    protected Identifier $productId;
    /**
     * @var Email
     */
    protected Email $email;
    /**
     * @var CustomerName
     */
    protected CustomerName $customerName;
    protected ProductName $productName;
    protected Identifier $orderId;

    public function setUp()
    {
        $this->customerId   = Identifier::fromString(Uuid::v4()->toRfc4122());
        $this->email        = Email::create('mariusz@kr.pl');
        $this->customerName = CustomerName::create('Mariusz Klemt');
        $this->birthDate    = AppDateTime::createFromFormat("1980-01-01", "Y-m-d");

        $this->productId   = Identifier::fromString(Uuid::v4()->toRfc4122());
        $this->productName = ProductName::create("Golden Eye");
        $this->orderId     = Identifier::fromString(Uuid::v4()->toRfc4122());
    }

}