<?php


namespace App\Tests\Unit\Order\Domain;

use App\Customer\Domain\CustomerName\CustomerName;
use App\Customer\Domain\Email\Email;
use App\Product\Domain\ProductName\ProductName;
use App\Shared\Domain\AppDateTime\AppDateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class OrderBase extends TestCase
{
    protected AppDateTime $birthDate;
    protected string $customerId;
    protected string $productId;
    protected Email $email;
    protected CustomerName $customerName;
    protected ProductName $productName;
    protected string $orderId;

    public function setUp()
    {
        $this->customerId   = Uuid::v4()->toRfc4122();
        $this->email        = Email::create('mariusz@kr.pl');
        $this->customerName = CustomerName::create('Mariusz Klemt');
        $this->birthDate    = AppDateTime::createFromFormat("1980-01-01", "Y-m-d");

        $this->productId   = Uuid::v4()->toRfc4122();
        $this->productName = ProductName::create("Golden Eye");
        $this->orderId     = Uuid::v4()->toRfc4122();

    }

}