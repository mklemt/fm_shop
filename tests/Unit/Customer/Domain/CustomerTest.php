<?php


namespace App\Tests\Unit\Customer\Domain;

use App\Customer\Domain\Customer\Customer;
use App\Customer\Domain\CustomerName\CustomerName;
use App\Customer\Domain\CustomerName\CustomerNameDomainException;
use App\Customer\Domain\Email\Email;
use App\Customer\Domain\Email\EmailDomainException;
use App\Shared\Domain\AppDateTime\AppDateTime;
use App\Shared\Domain\Identifier\Identifier;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class CustomerTest extends TestCase
{
    private string $id;
    private Email $email;
    private CustomerName $customerName;
    private AppDateTime $birthDate;

    public function setUp()
    {
        $this->id           = Uuid::v4()->toRfc4122();
        $this->email        = Email::create('mariusz@kr.pl');
        $this->customerName = CustomerName::create('Mariusz Klemt');
        $this->birthDate    = AppDateTime::createFromFormat("1980-01-01", "Y-m-d");
    }

    public function testCanICreateUser()
    {
        $customer = null;
        $customer = Customer::create($this->id, $this->customerName, $this->email, $this->birthDate);
        $this->assertNotNull($customer);
    }

    public function testIfUserIsAdult()
    {
        $customer = Customer::create($this->id, $this->customerName, $this->email, $this->birthDate);
        $this->assertTrue($customer->isAdult());
    }

    public function testIfUserIsNotAdult()
    {
        $birthDate = AppDateTime::createFromFormat("2015-01-01", "Y-m-d");
        $customer  = Customer::create($this->id, $this->customerName, $this->email, $birthDate);
        $this->assertFalse($customer->isAdult());
    }

    public function testIfUserEmailIsValid()
    {
        $this->expectException(EmailDomainException::class);
        $email    = Email::create('mariusz.kr.pl');
    }
    public function testIfUserNameIsValid()
    {
        $this->expectException(CustomerNameDomainException::class);
        $userName=   CustomerName::create("Ala");
    }

}