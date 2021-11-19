<?php

namespace App\Services;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use \App\Models\Customer;

class CustomerService
{
    protected $repository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->repository = $customerRepository;
    }

    public function index()
    {
        $customer = $this->repository->index();
        return $customer;
    }

    public function create(Request $request): Customer
    {
        $customer = $this->repository->store($request->all());
        return $customer;
    }

    public function update(Request $request): Customer
    {
        $customer = $this->repository->findOrFail($request->id);
        $customer = $this->repository->update($customer, $request->only(Customer::UpdatableAttributes));
        return $customer;
    }
}
