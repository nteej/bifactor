<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Invoice;

/**
 *
 */
class InvoiceRepository
{
    /**
     * @var Invoice
     */
    private $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Invoice();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->model->with('company', 'customer')->paginate(10);
    }

    /**
     * @param int $id
     * @return Invoice
     */
    public function findOrFail(int $id): Invoice
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return Invoice
     */
    public function store(array $attributes): Invoice
    {
        return $this->model->create($attributes);
    }

    /**
     * @param Invoice $customer
     * @param array $attributes
     * @return Invoice
     */
    public function update(Invoice $customer, array $attributes): Invoice
    {
        $customer->update($attributes);
        return $customer;
    }

    /**
     * @param int $companyId
     * @return mixed
     */
    public function companyInvoices(int $companyId)
    {
        return Invoice::with('customer', 'payments')
            ->company($companyId)
            ->paginate(10);
    }

    /**
     * @param int $customerId
     * @return mixed
     */
    public function customerInvoices(int $customerId)
    {
        return Invoice::with('company')
            ->customer($customerId)
            ->paginate(10);
    }


    /**
     * @param array $attributes
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function processInvoices(array $attributes)
    {
        return Invoice::with('company')
            ->paginate(10);
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function OpenInvoice(array $attributes): bool
    {
        $invTotal = Invoice::invoiceTotal($attributes['company_id']);
        $limit = Company::select('debtor_limit')->find($attributes['company_id']);
        $state = false;
        //7500-inv-tot,10000-$limit,4500-$invTotal
        // dd($invTotal['total_amount']);
        $debit_size = $limit['debtor_limit'] - $invTotal['total_amount'];

        if ($debit_size > 0) { //5500
            $invoice = Invoice::find($attributes['invoice_id']);

            if ($invTotal['total_amount'] <= $debit_size) {
                $invoice->update(['state' => 'open']);
                $state = true;
            }
        }
        return $state;
    }

}
