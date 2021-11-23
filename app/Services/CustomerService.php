<?php

namespace App\Services;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

/**
 *
 */
class CustomerService
{
    /**
     * @var CustomerRepository
     */
    protected $repository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->repository = $customerRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $customer = $this->repository->index();
        return $customer;
    }

    /**
     * @param Request $request
     * @return Customer
     */
    public function create(Request $request): Customer
    {
        $customer = $this->repository->store($request->all());
        return $customer;
    }

    /**
     * @param Request $request
     * @return Customer
     */
    public function update(Request $request): Customer
    {
        $customer = $this->repository->findOrFail($request->id);
        $customer = $this->repository->update($customer, $request->only(Customer::UpdatableAttributes));
        return $customer;
    }
}
