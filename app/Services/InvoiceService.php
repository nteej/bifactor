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
        $invoice = $this->repository->findOrFail($request->input('id'));
        $result = $this->repository->update($invoice, $request->only(Invoice::UpdatableAttributes));
        return $result;
    }

    public function listByCustomer(int $customerId)
    {
        $invoices = $this->repository->customerInvoices($customerId);
        return $invoices;
    }

    public function listByCompany(int $companyId)
    {
        $invoices = $this->repository->companyInvoices($companyId);
        return $invoices;
    }

    public function openInvoice(Request $request)
    {
        return $this->repository->OpenInvoice($request->all());
    }

    public function makePayment(Request $request)
    {
        return $this->repository->makePayment($request->all());
    }

    public function getInvoiceStatus(int $invoiceId)
    {
        return $this->repository->getInvoiceStatus($invoiceId);
    }

}
