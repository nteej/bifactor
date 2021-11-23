<?php

namespace App\Services;

use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;

/**
 *
 */
class InvoiceService
{
    /**
     * @var InvoiceRepository
     */
    protected $repository;

    /**
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->repository = $invoiceRepository;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        $invoice = $this->repository->index();
        return $invoice;
    }

    /**
     * @param Request $request
     * @return Invoice
     */
    public function create(Request $request): Invoice
    {
        $invoice = $this->repository->store($request->all());
        return $invoice;
    }

    /**
     * @param Request $request
     * @return Invoice
     */
    public function update(Request $request): Invoice
    {
        //dd($request->input('id'));
        $invoice = $this->repository->findOrFail($request->input('id'));
        $result = $this->repository->update($invoice, $request->only(Invoice::UpdatableAttributes));
        return $result;
    }

    /**
     * @param int $customerId
     * @return mixed
     */
    public function listByCustomer(int $customerId)
    {
        $invoices = $this->repository->customerInvoices($customerId);
        return $invoices;
    }

    /**
     * @param int $companyId
     * @return mixed
     */
    public function listByCompany(int $companyId)
    {
        $invoices = $this->repository->companyInvoices($companyId);
        return $invoices;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function openInvoice(Request $request)
    {
        return $this->repository->OpenInvoice($request->all());
    }

    /**
     * @param Request $request
     */
    public function makePayment(Request $request)
    {
        return $this->repository->makePayment($request->all());
    }

    /**
     * @param int $invoiceId
     * @return array|string
     */
    public function getInvoiceStatus(int $invoiceId)
    {
        return $this->repository->getInvoiceStatus($invoiceId);
    }

}
