<?php
namespace App\Repositories;
use App\Models\Customer;

class CustomerRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Customer();
    }

    public function index()
    {
        return $this->model->paginate(10);
    }

    public function findOrFail(int $id): Customer
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $attributes): Customer
    {
        return $this->model->create($attributes);
    }

    public function update(Customer $customer, array $attributes): Customer
    {
        $customer->update($attributes);
        return $customer;
    }
}
