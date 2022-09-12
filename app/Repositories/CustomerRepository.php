<?php

namespace App\Repositories;

interface CustomerRepository
{
    public function getAllCustomers(?int $paginate);
    public function updateOrCreateCustomer($data);
    public function updateOrCreateCustomerDependents($customer, array $dependents);
}
