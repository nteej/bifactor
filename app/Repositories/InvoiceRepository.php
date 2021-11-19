<?php
namespace App\Repositories;
use App\Models\Invoice;

class InvoiceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Invoice();
    }

    public function index()
    {
        return $this->model->with('company','customer')->paginate(10);
    }

    public function findOrFail(int $id): Invoice
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $attributes): Invoice
    {
        return $this->model->create($attributes);
    }

    public function update(Invoice $customer, array $attributes): Invoice
    {
        $customer->update($attributes);
        return $customer;
    }
}
