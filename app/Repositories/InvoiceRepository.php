<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return $this->model->with('company', 'customer', 'payments')->paginate(10);
    }

    /**
     * @param int $id
     * @return Invoice
     */
    public function findOrFail(int $id): Invoice
    {
        return $this->model->with('company', 'customer', 'payments')->findOrFail($id);
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
     * @return LengthAwarePaginator
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

    /**
     * @param int $invoiceId
     * @return array|string
     */
    public function getInvoiceStatus(int $invoiceId)
    {
        try {
            $invoice = Invoice::find($invoiceId);
            $paidAmount = Payment::creditPayments($invoiceId);
            $receivedAmount = Payment::debitPayments($invoiceId);
            $fee = ($invoice->factoring / 100) * $invoice->total_amount;
            $factoring = (1 - $invoice->factoring / 100) * $invoice->total_amount;
            $pay_due = $factoring - $paidAmount;
            $receive_due = $invoice->total_amount - $receivedAmount;
            $status = array(
                'total' => intval($invoice->total_amount),
                'fee' => $fee,
                'factoring' => $factoring,
                'pay_due' => $pay_due,
                'receive_due' => $receive_due
            );
            return $status;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }


    }

    /** @TODO
     * @param array $attributes
     */
    public function makePayment(array $attributes)
    {
        $inv_id = $attributes['invoice_id'];
        $invoice_status = $this->getInvoiceStatus($inv_id);
        $invoice = Invoice::where('state' , 'open')->orWhere('state' , 'paid')->find($inv_id);
        $payDue = $invoice_status['pay_due'];
        $receiveDue = $invoice_status['receive_due'];
        $payment = $attributes['amount'];
        $invoiceState = 'paid';
        $paymentState = 'debit';
        $info = array();
        if ($attributes['type'] == 1) {
            $paymentState = 'credit';
            if ($payment <= $payDue) {
                $info = array(
                    "comments" => $invoice_status
                );
            }
        }
        //Close invoice if total when receivables & paybles  become 0.
        //If invoice is closed total accountability & processable almost finished
        if ($receiveDue == 0 && $payDue == 0) {
            $invoiceState = 'closed';
        }
        if (isset($invoice)) {
            $invoice->update(['state' => $invoiceState]);
            $payment = Payment::create([
                    'invoice_id' => $inv_id,
                    'amount' => $payment,
                    'state' => $paymentState,
                    'info' => $info
                ]
            );
            return $payment;
        }
    }
}
