<?php


namespace App\Customer\Domain;

use App\Customer\Domain\Customer\Customer;

interface CustomerRepositoryInterface
{
    public function getById(string $uuid): ?Customer;

    public function save(Customer $customer);

}