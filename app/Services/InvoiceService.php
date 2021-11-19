<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;
use \App\Models\Invoice;

class InvoiceService
{
    protected $repository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->repository = $invoiceRepository;
    }

    public function index()
    {
        $invoice = $this->repository->index();
        return $invoice;
    }

    public function create(Request $request): Invoice
    {
        $invoice = $this->repository->store($request->all());
        return $invoice;
    }

    public function update(Request $request): Invoice
    {
        $invoice = $this->repository->findOrFail($request->id);
        $invoice = $this->repository->update($invoice, $request->only(Invoice::UpdatableAttributes));
        return $invoice;
    }
}
